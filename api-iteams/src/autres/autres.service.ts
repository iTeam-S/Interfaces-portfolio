import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Autres, Membre } from 'src/output';
import { Repository } from 'typeorm';
import { AutresCreateDto, AutresUpdateDto } from './dto/autres.dto';

@Injectable()
export class AutresService {
    constructor(
        @InjectRepository(Autres)
        private autresRepository: Repository<Autres>
    ) {}

    async findOne(donnees: {id: number}): Promise<Autres[]> {
        return await this.autresRepository
        .createQueryBuilder('a')
        .select([
            "a.nom as nom", "a.lien as lien", 
            "m.prenom_usuel as prenom_usuel"
        ])
        .innerJoin(Membre, "m", "a.id_membre=m.id")
        .where(`m.id=:identifiant`, { identifiant: donnees.id })
        .getRawMany();
    }

    async create(id_membre: number, 
        donnees: AutresCreateDto): Promise<void> {
        await this.autresRepository
        .createQueryBuilder()
        .insert()
        .into(Autres)
        .values({
            nom: donnees.nom,
            lien: donnees.lien,
            idMembre: id_membre
        })
        .execute();
    }

    async update(id_membre: number, 
        donnees: AutresUpdateDto) {
        await this.autresRepository
        .createQueryBuilder('a')
        .update(Autres)
        .set({
            nom: donnees.nom,
            lien: donnees.lien
        })
        .where(`a.id=:id AND a.id_membre=:identifiant`, {
            id: donnees.id,
            identifiant: id_membre
        })
        .execute();
    }
}

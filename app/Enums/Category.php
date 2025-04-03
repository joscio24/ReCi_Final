<?php

namespace App\Enums;

enum Category: string
{
    case ECONOMIE_ET_DEVELOPPEMENT = 'economie_et_developpement';
    case EDUCATION = 'education';
    case SANTE_PUBLIQUE = 'sante_publique';
    case RELATIONS_INTERNATIONALE = 'relations_internationale';
    case DROITS_HUMAINS_ET_CITOYENNETE = 'droits_humains_et_citoyennete';
    case POLITIQUE = 'politique';
    case ENVIRONNEMENT_ET_DEVELOPPEMENT = 'environnement_et_developpement';
    case TECHNOLOGIE_ET_INNOVATION = 'technologie_et_innovation';
    case SECURITE_ET_DEFENSE = 'securite_et_defense';
}


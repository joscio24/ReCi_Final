<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Enums\Category;
use App\Models\Debat;

class DebatSeeder extends Seeder
{
    public function run()
    {
        $user = User::first() ?? User::factory()->create(); // Ensure at least one user

        $data = [
            [
                'titre' => 'Sécurité : Et si les citoyens devenaient les premiers acteurs ?',
                'description' => "Dans un contexte marqué par des enjeux de sécurité frontalière et urbaine au Bénin, le concept de \"sécurité de proximité\" revient régulièrement dans les discours publics. Pourtant, sa mise en œuvre reste encore mal comprise ou mal appropriée par les citoyens. Faut-il repenser le rôle des communautés dans la prévention de l'insécurité ? Quelle place pour les comités de vigilance ou les plateformes locales d'alerte citoyenne ?\n\nDonnez votre avis : Selon vous, quelles sont les meilleures manières pour les citoyens de contribuer à leur propre sécurité sans remplacer les forces de l’ordre ?",
                'image' => 'cover1.png',
                'category' => Category::SECURITE_ET_DEFENSE,
                'statut' => 'Validé',
                'id_user' => $user->id,
                'date_debut' => Carbon::now()->subDays(5),
                'date_fin' => Carbon::now()->addDays(10),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'titre' => 'Pouvoir d’achat au Bénin : Entre inflation et débrouillardise, que faire ?',
                'description' => "Les prix des produits de première nécessité ont connu une hausse significative ces dernières années, tandis que les revenus des ménages stagnent pour beaucoup. Face à cette situation, certains appellent à un renforcement des mesures sociales, d'autres misent sur l'entrepreneuriat ou l'économie locale. Le gouvernement parle de \"résilience\", mais sur le terrain, les réalités sont dures.\n\nPartagez votre expérience : Comment vivez-vous cette situation ? Quelles solutions concrètes devraient être mises en œuvre pour soulager les citoyens ?",
                'image' => 'cover2.png',
                'category' => Category::ECONOMIE_ET_DEVELOPPEMENT,
                'statut' => 'Validé',
                'id_user' => $user->id,
                'date_debut' => Carbon::now()->subDays(3),
                'date_fin' => Carbon::now()->addDays(15),
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'titre' => 'Éducation au Bénin : L’école forme-t-elle encore pour la vie ?',
                'description' => "Malgré les réformes engagées dans le système éducatif (gratuité, modernisation des programmes, formation technique), de nombreux jeunes sortent de l’école sans compétences concrètes pour le monde du travail. L’adéquation formation-emploi semble toujours poser problème, et la qualité des apprentissages reste inégale.\n\nOpinez : L’école béninoise répond-elle encore aux défis actuels de la société ? Quelles réformes vous semblent prioritaires ?",
                'image' => 'cover3.png',
                'category' => Category::EDUCATION,
                'statut' => 'Validé',
                'id_user' => $user->id,
                'date_debut' => Carbon::now()->subDays(2),
                'date_fin' => Carbon::now()->addDays(20),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now(),
            ],
        ];


        foreach ($data as $sujet) {
            Debat::create($sujet);
        }
    }
}


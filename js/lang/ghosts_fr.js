function ghostPowers() {
    return {
        'spirit': {
            'name': "Esprit",
            'power': "Aucun pouvoir",
            'weakness': "L'utilisation d'encens dans la pièce du fantôme l'empêchera d'attaquer pendant 180 secondes (90 secondes pour les autres fantômes)."
        },
        'wraith': {
            'name': "Spectre",
            'power': "Les Spectres ne laissent pas d'empreintes de pas à la lumière UV après avoir marché sur un tas de sel. Si la cible du Spectre est dans le lieu hanté (et vivante), il se téléportera à 3 mètres de sa victime.",
            'weakness': "Le Spectre possède un multiplicateur d'action qui sera porté à 50 après avoir marché dans le sel. Il entrera moins souvent dans la phase d'attaque."
        },
        'phantom': {
            'name': "Fantôme",
            'power': "Le Fantôme reste visible plus longtemps que les autres fantômes. Regarder le Fantôme vous fera perdre de la santé mentale.",
            'weakness': "Prendre une photo de lui le fera disparaître pour une courte période. [Cela n'arrête pas une attaque]"
        },
        'poltergeist': {
            'name': "Poltergeist",
            'power': "Le Poltergeist lancera beaucoup d'objets autour de lui, si un joueur se trouve auprès des objets lancés, sa santé mentale sera réduite de 2 fois le nombre d'objets lancés.",
            'weakness': "S'il se trouve dans une pièce vide, son pouvoir n'est pas possible. Il retournera donc à une phase d'inactivité."
        },
        'banshee': {
            'name': "Banshee",
            'power': "La Banshee peut entrer dans la phase de navigation. Pendant cette phase : si la cible, choisie par la Banshee, marche devant le fantôme, une phase d'attaque commence. (Indépendamment de la santé mentale)",
            'weakness': "Si la cible de la Banshee se trouve en dehors du lieu hanté, la Banshee ne peut pas utiliser son pouvoir. Elle agira/attaquera comme un fantôme classique. Les crucifix ont une efficacité de 5 mètres pour les Banshee."
        },
        'jinn': {
            'name': "Djinn",
            'power': "Être à moins de 3 mètres d'un Djinn fait chuter instantanément votre santé mentale de 25%. Sa capacité lui permet de se déplacer rapidement si la cible est éloignée de lui, mais reviendra à une vitesse normale une fois qu'une cible sera proche de lui.",
            'weakness': "Couper l'électricité permet de bloquer le pouvoir du Djinn. Le Djinn est facile à repérer, il génère en permanence un champ EMF 2."
        },
        'mare': {
            'name': "Cauchemar",
            'power': "Si les lumières de la pièce où se trouve le Cauchemar sont éteintes, son multiplicateur d'attaque augmente de 10.",
            'weakness': "Si les lumières de la pièce où se trouve le Cauchemar sont allumées, son multiplicateur d'attaque est réduit de 10."
        },
        'revenant': {
            'name': "Revenant",
            'power': "Lorsqu'il poursuit un joueur, il est 2x plus rapides que les autres fantômes.",
            'weakness': "Les Revenants se déplacent 50% plus lentement que les autres fantômes lorsqu'ils ne poursuivent pas un joueur."
        },
        'shade': {
            'name': "Ombre",
            'power': "L'Ombre est très discrète, elle ne se révèle qu'aux personnes seules et elle y a une chance d'entrer dans la phase d'attaque si on laisse une personne seule.",
            'weakness': "S'il y a plus d'un joueur dans la salle fantôme, la phase d'attaque n'est pas lancée."
        },
        'demon': {
            'name': "Démon",
            'power': "Le démon est très agressif, il peut entrer en phase d'attaque dès que la santé mentale est inférieure à 80% en moyenne.",
            'weakness': "Poser une bonne question à la table de ouija ne vous fera pas perdre votre santé mentale."
        },
        'yurei': {
            'name': "Yurei",
            'power': "Le Yurei a une force de drainage de la santé mentale deux fois plus forte que les autres fantômes. (0,4 de santé mentale drainée)",
            'weakness': "L'encens empêchera le Yurei d'errer pendant 90 secondes."
        },
        'oni': {
            'name': "Oni",
            'power': "L'activité de l'Oni (actions / chasse) augmente s'il y a des gens dans sa pièce. Il fera voles des objets autour de sa victime. Si sa victime voit un objet voler, elle deviendra la cible de l'Oni.",
            'weakness': "L'augmentation de l'activité du Oni permet également de le trouver plus facilement."
        }
    }
}
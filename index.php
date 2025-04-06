<?php
require_once 'Pokemon.php'; // Inclure le fichier contenant les classes Pokémon

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données des Pokémon depuis le formulaire
    $name1 = $_POST['pokemon1'];
    $hp1 = intval($_POST['hp1']);
    $type1 = $_POST['type1'];

    $name2 = $_POST['pokemon2'];
    $hp2 = intval($_POST['hp2']);
    $type2 = $_POST['type2'];

    // Créer les objets AttackPokemon pour chaque Pokémon
    $attack1 = new AttackPokemon(10, 20, 2, 30); // Exemple d'attaques pour Pokémon 1
    $attack2 = new AttackPokemon(15, 25, 3, 40); // Exemple d'attaques pour Pokémon 2

    // Créer les objets Pokémon en fonction de leur type
    $pokemon1 = match ($type1) {
        'Plante' => new PokemonFeu($name1, 'https://www.pokemon.com/fr/pokedex/brindibou', $hp1, $type1, $attack1),
        'Eau' => new PokemonEau($name1, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.cnn.com%2Fstyle%2Farticle%2Fpokemon-design-25%2Findex.html&psig=AOvVaw0iBik7aR1ZpIYy7MvSWsMy&ust=1743986678288000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCKCa1uqWwowDFQAAAAAdAAAAABAJ', $hp1, $type1, $attack1),
        'Feu' => new PokemonPlante($name1, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.businessinsider.com%2Fevery-pokemon-in-pokemon-go-list-2016-8&psig=AOvVaw0iBik7aR1ZpIYy7MvSWsMy&ust=1743986678288000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCKCa1uqWwowDFQAAAAAdAAAAABAP', $hp1, $type1, $attack1),
        default => new Pokemon($name1, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.nintendo.com%2Ffr-fr%2FNews%2F2016%2FAout%2FQue-sont-les-Pokemon-Decouvrez-tout-ce-qu-il-faut-savoir-sur-le-phenomene-Pokemon--1128960.html&psig=AOvVaw0iBik7aR1ZpIYy7MvSWsMy&ust=1743986678288000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCKCa1uqWwowDFQAAAAAdAAAAABAV', $hp1, $type1, $attack1),
    };

    $pokemon2 = match ($type2) {
        'Feu' => new PokemonFeu($name2, '', $hp2, $type2, $attack2),
        'Eau' => new PokemonEau($name2, '', $hp2, $type2, $attack2),
        'Plante' => new PokemonPlante($name2, '', $hp2, $type2, $attack2),
        default => new Pokemon($name2, '', $hp2, $type2, $attack2),
    };

    // Simuler une attaque
    ob_start(); // Capturer la sortie
    $pokemon1->attack($pokemon2);
    $result = ob_get_clean(); // Récupérer la sortie
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu Pokémon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .pokemon-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .pokemon {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            width: 200px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Jeu Pokémon</h1>
    <p>Sélectionnez deux Pokémon et lancez le combat !</p>

    <form method="POST">
        <div class="pokemon-container">
            <div class="pokemon">
                <h3>Pokémon 1</h3>
                <label for="pokemon1">Nom :</label>
                <input type="text" id="pokemon1" name="pokemon1" placeholder="Nom du Pokémon 1" required><br><br>
                <label for="hp1">HP :</label>
                <input type="number" id="hp1" name="hp1" placeholder="Points de vie" required><br><br>
                <label for="type1">Type :</label>
                <select id="type1" name="type1">
                    <option value="Feu">Feu</option>
                    <option value="Eau">Eau</option>
                    <option value="Plante">Plante</option>
                    <option value="Normal">Normal</option>
                </select>
            </div>
            <div class="pokemon">
                <h3>Pokémon 2</h3>
                <label for="pokemon2">Nom :</label>
                <input type="text" id="pokemon2" name="pokemon2" placeholder="Nom du Pokémon 2" required><br><br>
                <label for="hp2">HP :</label>
                <input type="number" id="hp2" name="hp2" placeholder="Points de vie" required><br><br>
                <label for="type2">Type :</label>
                <select id="type2" name="type2">
                    <option value="Feu">Feu</option>
                    <option value="Eau">Eau</option>
                    <option value="Plante">Plante</option>
                    <option value="Normal">Normal</option>
                </select>
            </div>
        </div>

        <button type="submit">Lancer le combat</button>
    </form>

    <div id="result" style="margin-top: 20px;">
        <?php if (!empty($result)) echo nl2br($result); ?>
    </div>
</body>
</html>
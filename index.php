<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Pokémon - Dracaufeu Gigamus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #e74c3c;
            text-align: center;
        }
        h2 {
            color: #3498db;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }
        .pokemon-card {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .pokemon-image {
            width: 150px;
            margin-right: 20px;
        }
        .pokemon-image img {
            width: 100%;
            height: auto;
        }
        .pokemon-info {
            flex: 1;
        }
        .stats {
            margin-left: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .combat-form {
            margin-top: 30px;
            padding: 20px;
            background-color: #eaf2f8;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        input, select {
            padding: 8px;
            width: 200px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .code-container {
            background-color: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once 'Pokemon.php';
        
        
        $attack = new AttackPokemon(10, 100, 2, 20);
        $dracaufeu1 = new PokemonFeu("Dracaufeu Gigamus", "https://assets.pokemon.com/assets/cms2/img/pokedex/full/006.png", 200, "Feu", $attack);
        
        $attack2 = new AttackPokemon(10, 80, 4, 20);
        $dracaufeu2 = new PokemonFeu("Dracaufeu Gigamus", "https://assets.pokemon.com/assets/cms2/img/pokedex/full/006.png", 200, "Feu", $attack2);
        
        
        echo '<div class="pokemon-card">';
        echo '  <div class="pokemon-image">';
        $dracaufeu1->displayImage();
        echo '  </div>';
        echo '  <div class="pokemon-info">';
        echo '    <h2>' . $dracaufeu1->getName() . '</h2>';
        echo '    <div class="stats">';
        echo '      <p>- Points: ' . $dracaufeu1->getHp() . '</p>';
        echo '      <p>- Min Attack: ' . $attack->getAttackMinimal() . '</p>'; 
        echo '      <p>- Max Attack: ' . $attack->getAttackMaximal() . '</p>'; 
        echo '      <p>- Special Attack: ' . $attack->getSpecialAttack() . '</p>';
        echo '      <p>- Special Probability: ' . $attack->getProbabilitySpecialAttack() . '%</p>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
        
        echo '<div class="pokemon-card">';
        echo '  <div class="pokemon-image">';
        $dracaufeu2->displayImage();
        echo '  </div>';
        echo '  <div class="pokemon-info">';
        echo '    <h2>' . $dracaufeu2->getName() . '</h2>';
        echo '    <div class="stats">';
        echo '      <p>- Points: ' . $dracaufeu2->getHp() . '</p>';
        echo '      <p>- Min Attack: ' . $attack2->getMinAttack() . '</p>';
        echo '      <p>- Max Attack: ' . $attack2->getMaxAttack() . '</p>';
        echo '      <p>- Special Attack: ' . $attack2->getSpecialAttack() . '</p>';
        echo '      <p>- Special Probability: ' . $attack2->getSpecialProbability() . '%</p>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rounds = isset($_POST['rounds']) ? (int)$_POST['rounds'] : 1;
            echo '<h2>Résultats du combat</h2>';
            echo '<table>';
            echo '<tr><th>Round</th><th>Attaque</th><th>Défense</th><th>Dégâts</th><th>Points restants</th></tr>';
            
            for ($i = 1; $i <= $rounds; $i++) {
                $attackValue1 = $dracaufeu1->attack(1); // Pass appropriate argument
                $attackValue2 = $dracaufeu2->attack(1); // Pass appropriate argument
            
                
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $attackValue1 . '</td>';
                echo '<td>' . $attackValue2 . '</td>';
                echo '<td>' . $attackValue1 . ' / ' . $attackValue2 . '</td>';
                echo '<td>' . $dracaufeu1->getHp() . ' / ' . $dracaufeu2->getHp() . '</td>';
                echo '</tr>';
                
                if ($dracaufeu1->getHp() <= 0 || $dracaufeu2->getHp() <= 0) {
                    break;
                }
            }
            
            echo '</table>';
            
            if ($dracaufeu1->getHp() > $dracaufeu2->getHp()) {
                echo '<p style="color: green; font-weight: bold;">' . $dracaufeu1->getName() . ' a gagné le combat!</p>';
            } elseif ($dracaufeu2->getHp() > $dracaufeu1->getHp()) {
                echo '<p style="color: green; font-weight: bold;">' . $dracaufeu2->getName() . ' a gagné le combat!</p>';
            } else {
                echo '<p style="color: blue; font-weight: bold;">Match nul!</p>';
            }
        }
        ?>
        
        <div class="combat-form">
            <h2>Configuration du combat</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="rounds">Nombre de rounds:</label>
                    <input type="number" id="rounds" name="rounds" value="1" min="1" max="10">
                </div>
                <button type="submit">Lancer le combat</button>
            </form>
        </div>
        
        <div class="code-container">
            <h3 style="color: #f8f8f2;">Code PHP utilisé:</h3>
            <pre style="color: #f8f8f2;">
<?php
require_once 'Pokemon.php';

$attack = new AttackPokemon(10, 100, 2, 20);
$dracaufeu1 = new PokemonFeu("Dracaufeu Gigamus", "pokemon.png", 200, "Feu", $attack);

$attack2 = new AttackPokemon(10, 80, 4, 20);
$dracaufeu2 = new PokemonFeu("Dracaufeu Gigamus", "pokemon.png", 200, "Feu", $attack2);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rounds = (int)$_POST['rounds'];
    
    for ($i = 1; $i <= $rounds; $i++) {
        $attackValue1 = $dracaufeu1->attack();
        $attackValue2 = $dracaufeu2->attack();
        
        $dracaufeu2->takeDamage($attackValue1);
        $dracaufeu1->takeDamage($attackValue2);
        
        if ($dracaufeu1->getHp() <= 0 || $dracaufeu2->getHp() <= 0) {
            break;
        }
    }
} ?>
            </pre>
        </div>
    </div>
</body>
</html>
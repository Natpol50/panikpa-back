<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Config/configManager.php';
require_once __DIR__ . '/../src/Config/database.php';

try {
    echo "Connexion à la base de données...\n";
    
    // Obtenir une connexion à la base de données
    $pdo = Database::getInstance();
    
    // Requête simple pour afficher toutes les tables
    $stmt = $pdo->query('SHOW TABLES');
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "Tables dans la base de données:\n";
        echo "=============================\n";
        
        foreach ($tables as $index => $table) {
            $tableNumber = $index + 1;
            echo "{$tableNumber}. {$table}\n";
            
            // Afficher les informations sur les colonnes
            $columnStmt = $pdo->query("DESCRIBE `{$table}`");
            $columns = $columnStmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "   Colonnes:\n";
            foreach ($columns as $column) {
                echo "   - {$column['Field']} ({$column['Type']})\n";
            }
            echo "\n";
        }
    } else {
        echo "Aucune table trouvée dans la base de données.\n";
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
}

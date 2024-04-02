
require_once __DIR__."/../../config.php";


$sql = "SELECT * 
        FROM Livre
        JOIN Type_Livre ON Livre.ISBN = Type_Livre.isbn_livre 
        JOIN Categorie_Livre ON Livre.ISBN = Categorie_Livre.isbn_livre
        WHERE (:categorie=Categorie_Livre.id_categorie OR :type=Type_Livre.id_type)";
        WHERE (Categorie_Livre.id_categorie = :categorie OR Type_Livre.id_type = :type)";


$stmt = $pdo->prepare($sql);


if ($livres) {

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livres);
    exit;
} else {

    header("HTTP/1.0 404 Not Found");
    exit;
}
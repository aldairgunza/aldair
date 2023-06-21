<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar a conexão e exibir a mensagem apropriada
    if (realizarConexao()) {
        echo "<script>alert('Dados enviados com sucesso!')</script>";
    } else {
        echo "Falha na conexão.";
    }
}

function realizarConexao() {
    // Configurações de conexão ao banco de dados
    $servername = "192.168.1.33";
    $username = "admin";
    $password = "angola2023..";
    $dbname = "bd_afmex";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar se houve erros na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    } else {
        // Conexão bem-sucedida
        // Aqui você pode adicionar ações adicionais, consultas, etc.
        $email = $_POST['email'];
     
        $stmt = $conn->prepare("INSERT INTO tblnews (gmail) VALUES (?)");
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {

        	
            header('Location:index.html');
            
        } else {
            echo "Erro: " . $stmt->error;
           
        }
        
        // $stmt->close();
        $conn->close(); // Fechar a conexão
        return true;
    }
}
?>
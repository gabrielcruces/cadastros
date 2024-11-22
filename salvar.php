[16:49, 22/11/2024] Gabriel Cruces: document.getElementById("cadastroForm").addEventListener("submit", function (e) {
    const cpf = document.getElementById("cpf").value;
    if (cpf && !validarCPF(cpf)) {
        e.preventDefault();
        alert("CPF inválido. Por favor, verifique os dados.");
    }
});

function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
    let soma = 0, resto;
    for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) return false;
    soma = 0;
    for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    return resto === parseInt(cpf.substring(10, 11));
}
[16:50, 22/11/2024] Gabriel Cruces: Nnnn
[16:50, 22/11/2024] Gabriel Cruces: <?php
// Configuração do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "cadastro";

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data_nascimento'];

// Inserir no banco de dados
$sql = "INSERT INTO usuarios (nome, sobrenome, rg, cpf, data_nascimento) 
        VALUES ('$nome', '$sobrenome', '$rg', '$cpf', '$data_nascimento')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fechar conexão
$conn->close();
?>
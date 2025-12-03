<?php

const CHEQUE_ESPECIAL = 500;
$clientes = [];

function cadastrarCliente(&$clientes): bool
{

    $nome = readline('Informe seu nome: ');
    $cpf  = readline('Informe seu CPF: ');

    //validar cliente
    if (isset($clientes[$cpf])) {
        print('Esse CPF já possui cadastro.\n');
        return false;
    }

    $clientes[$cpf] = [
        'nome' => $nome,
        'cpf' => $cpf,
        'contas' => []
    ];

    return true;
}

function cadastrarConta(array &$clientes): bool
{

    $cpf = readline("Informe seu CPF:");

    if (!isset($clientes[$cpf])) {
        print "Cliente não possui cadastro \n";
        return false;
    }

    $numConta = rand(10000, 100000);

    $clientes[$cpf]['contas'][$numConta] = [
        'saldo' => 0,
        'cheque_especial' => CHEQUE_ESPECIAL,
        'extrato' => []
    ];

    print "Conta criada com sucesso\n";
    print "O número da sua conta é: $numConta";
    return true;
}

function depositar(array &$clientes)
{
    $cpf = readline("Informe seu CPF novamente: ");

    $numConta = readline("Informe o número da conta:");

    $valorDeposito = (float) readline("Informe o valor do depósito: ");

    if ($valorDeposito <= 0) {
        print "Valor de depósito inválido\n";
        return false;
    }

    $clientes[$cpf]['contas'][$numConta]['saldo'] += $valorDeposito;

    $dataHora = date('d/m/Y H:i');
    $clientes[$cpf]['contas'][$numConta]['extrato'][] = "Depósito de R$ $valorDeposito em $dataHora";


    print "Depósito realizado com sucesso\n";
    return true;
}

// MENU PRINCIPAL
function menu()
{
    print str_repeat("=", 20);
    print " MEU BANCO EM PHP ";
    print str_repeat("=", 20) . "\n";
    print "1 - cadastrar cliente\n";
    print "2 - cadastrar conta\n";
    print "3 - cadastrar depositar\n";
    print "4 - cadastrar sacar\n";
    print "5 - cadastrar consultar saldo\n";
    print "6 - consultar extrato\n";
    print "7 - sair\n";
    print str_repeat("=", 58) . "\n";
}


//PROGRAMA PRINCIPAL
while (true) {

    menu();

    $opcao = readline();

    switch ($opcao) {
        case '1':
            cadastrarCliente($clientes);
            break;
        case '2':
            cadastrarConta($clientes);
            break;
        case '3':
            depositar($clientes);
            break;
        case '4':
            sacar($clientes);
            break;

        case '7':
            print "Obrigado por usar nosso banco";
            die();

        default:
            print "Opção inválida";
            break;
    }
}

function sacar(&$clientes)
{
    $cpf = readline("Informe seu CPF: ");
    $conta = readline("Informe o número da conta: ");
    $valorSaque = readline("Informe o valor do saque: ");
    if ($clientes[$cpf]['contas'][$conta]['saldo'] >=$valorSaque){
    $clientes[$cpf]['contas'][$conta]['saldo'] -= $valorSaque;
    }
}

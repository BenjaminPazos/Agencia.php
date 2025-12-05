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
    print "O número da sua conta é: $numConta\n";
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
    print "3 - Depositar\n";
    print "4 - Sacar\n";
    print "5 - Consultar saldo\n";
    print "6 - Consultar extrato\n";
    print "7 - Consultar cliente\n";
    print "8 - Sair\n";
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
        case '5':
            ConsultarSaldo($clientes);
            break;
        case '6':
            ConsultarExtrato($clientes);
            break;
        case '7':
            break;

        case '8':
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
    $numConta = readline("Informe o número da conta: ");
    $valorSaque = readline("Informe o valor do saque: ");
    if ($clientes[$cpf]['contas'][$numConta]['saldo'] >= $valorSaque) {
        $clientes[$cpf]['contas'][$numConta]['saldo'] -= $valorSaque;
        $dataHora = date('d/m/Y H:i');
        $clientes[$cpf]['contas'][$numConta]['extrato'][] = "Saque de R$ $valorSaque em $dataHora";
    }
}

function ConsultarSaldo(&$clientes)
{
    $cpf = readline("Informe seu CPF: ");
    $numConta = readline("Informe o número da conta: ");
    $saldo =  $clientes[$cpf]['contas'][$numConta]['saldo'];
    $cheque_especial = CHEQUE_ESPECIAL;
    print "Cheque Especial: R$$cheque_especial\n";
    print "Saldo: R$$saldo\n";
}
function ConsultarExtrato(&$clientes)
{
    $cpf = readline("Informe seu CPF: ");
    $numConta = readline("Informe o número da conta: ");
    $extrato =  $clientes[$cpf]['contas'][$numConta]['extrato'][0];
    print $extrato;
}

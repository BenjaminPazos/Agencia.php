<?php

const CHEQUE_ESPECIAL = 500;
$clientes = []; //global

function cadastrarCliente(&$clientes): bool
{

    $nome = readline('Informe seu nome: ');
    $cpf = readline('Informe seu CPF: ');

    //validar cliente
    if (isset($cliente[$cpf])) {
        print('Esse CPF já possui cadastro');
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
    $cpf = readline("Informe seu CPF: ");

    if (! isset($cliente[$cpf])) {
        print "Cliente não possui cadastro \n";
        return false;
    }

    $numConta = rand(10000, 100000);

    $clientes[$cpf]['contas'][$numConta] = [
        'saldo' => 0,
        'chequeEspecial' => CHEQUE_ESPECIAL,
        'extrato' => []
    ];

    print "Conta criada com sucesso\n";
    print "Número da sua conta: $numConta\n";
    return true;
}

function depositar(array &$clientes)
{
    $cpf = readline("Informe seu CPF novamente: ");

    $numConta = readline("Informe o número da conta: ");

    $valorDeposito = (float)readline("Informe o valor do depósito: ");

    if ($valorDeposito <= 0) {
        print "Valor de depósito inválido\n";
        return false;
    }

    $clientes[$cpf]['contas'][$numConta]['saldo'] += $valorDeposito;

    $dataHora = date('d/m/Y H:i');
    $clientes[$cpf]['contas'][$numConta]['extrato'][] = "Deposito de R$ $valorDeposito em $dataHora";

    print "Deposito realizado com sucesso\n";
    return true;
}

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
menu();

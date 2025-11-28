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

    $numConta = uniqid();
    $clientes[$cpf]['contas'][$numConta] = [
        'saldo' => 0,
        'chequeEspecial' => CHEQUE_ESPECIAL,
        'extrato' => []
    ];

    print "Conta criada com sucesso\n";
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

    $dataHora = date('d/m/YYYY H:i');
    $clientes[$cpf]['contas'][$numConta]['extrato'][] = "Deposito de R$ $valorDeposito em $dataHora";

    print "Deposito realizado com sucesso\n";
    return true;
}

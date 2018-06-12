<?php

class RegistroFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('usuarios/create');
    }

    public function abrirFormularioRegistro(\FunctionalTester $I)
    {
        $I->see('Registrarse', 'strong');

    }


    public function enviarFormularioErrores(\FunctionalTester $I)
    {
        $I->submitForm('#form_user', [
            'email'=>'aaaaa',
        ]);
        $I->expectTo('see validations errors');
        $I->see("Correo electrónico no es una dirección de correo válida.");
    }

    public function enviarFormularioCorrecto(\FunctionalTester $I)
    {
        $I->submitForm('#form_user', [
            'nombre'=>'paco',
            'password'=>'paco',
            'password_repeat'=>'paco',
            'email'=>'paco@gmail.com'
        ]);

        $I->dontSeeElement('#form_user');
    }
}

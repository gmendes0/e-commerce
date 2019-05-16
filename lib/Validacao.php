<?php

    class Validacao
    {
        private $session_login_field;
        private $errors;
        private $msgs;
        private $valido;
        private $validation_check;

        public function __construct()
        {
            $this->setMsgs([
                'required' => 'o campo __nomedocampo__ é obrigatório',
                'min' => 'valor mínimo do campo __nomedocampo__: __limite__',
                'max' => 'valor máximo do campo __nomedocampo__: __limite__',
                'numeric' => 'o campo __nomedocampo__ deve ser numérico',
                'email' => 'email inválido'
            ]);
            $this->setSession_login_field('usuario');
            $this->setValidation_check(false);
            $this->setValido(false);
        }

        /**
         * verifica se o usuario está logado
         */
        public function isLoggedIn()
        {

            $aceito = true;

            if(empty($_SESSION)){
                $aceito = false;
            }

            if(empty($_SESSION[$this->getSession_login_field()])){
                $aceito = false;
            }

            if(!$aceito){
                return header('Location: login.php');
            }

        }

        /**
         * validação de formulário
         * @param array $validate
         */
        // public function validation(['nome' => 'requerido|minimo'])
        public function validation($validate)
        {

            if(is_array($validate)){

                foreach ($validate as $key => $value){
                    
                    $type = explode('|', $value);

                    if(!is_array($type)){
                        $type[0] = $type;
                    }

                    if(count($type) >= 1){

                        foreach ($type as $valor){

                            switch($valor)
                            {
                                case 'required':
                                    if(empty($_POST[$key])){

                                        $this->setErrors(str_replace('__nomedocampo__', $key, $this->getMsgs()['required']));

                                    }
                                    break;

                                case 'min:'.filter_var($valor, FILTER_SANITIZE_NUMBER_INT):
                                    $limite = explode(':', $valor)[1];
                                    if(filter_var($_POST[$key], FILTER_VALIDATE_INT) || filter_var($_POST[$key], FILTER_VALIDATE_FLOAT)){

                                        if($_POST[$key] < $limite){
                                            $replace = str_replace('__nomedocampo__', $key, $this->getMsgs()['min']);
                                            $replace = str_replace('__limite__', $limite, $replace);
                                            $this->setErrors($replace);
                                        }

                                    }else{

                                        if(strlen($_POST[$key]) < $limite){
                                            $replace = str_replace('__nomedocampo__', $key, $this->getMsgs()['min']);
                                            $replace = str_replace('__limite__', $limite.' caracteres', $replace);
                                            $this->setErrors($replace);
                                        }

                                    }
                                    break;
                                // case 'max:5':
                                case 'max:'.filter_var($valor, FILTER_SANITIZE_NUMBER_INT):

                                    $limite = explode(':', $valor)[1];
                                    if(filter_var($_POST[$key], FILTER_VALIDATE_INT) || filter_var($_POST[$key], FILTER_VALIDATE_FLOAT)){

                                        if($_POST[$key] > $limite){
                                            $replace = str_replace('__nomedocampo__', $key, $this->getMsgs()['max']);
                                            $replace = str_replace('__limite__', $limite, $replace);
                                            $this->setErrors($replace);
                                        }

                                    }else{

                                        if(strlen($_POST[$key]) > $limite){
                                            $replace = str_replace('__nomedocampo__', $key, $this->getMsgs()['max']);
                                            $replace = str_replace('__limite__', $limite.' caracteres', $replace);
                                            $this->setErrors($replace);
                                        }

                                    }
                                    
                                    break;
                                case 'numeric':
                                    if(!filter_var($_POST[$key], FILTER_VALIDATE_INT) || !filter_var($_POST[$key], FILTER_VALIDATE_FLOAT)){
                                        $this->setErrors(str_replace('__nomedocampo__', $key, $this->getMsgs()['numeric']));
                                    }
                                    break;
                                case 'email':
                                    if(!filter_var($_POST[$key], FILTER_VALIDATE_EMAIL)){
                                        $this->setErrors(str_replace('__nomedocampo__', $key, $this->getMsgs()['email']));
                                    }
                                    break;
                            }

                            $this->setValidation_check(true);

                        }

                    }

                }

            }
        }

        //---------------------------------------------------------------------------------------//
        // GETTERS & SETTERS //
        //---------------------------------------------------------------------------------------//

        /**
         * Get the value of session_login_field
         */ 
        private function getSession_login_field()
        {
            return $this->session_login_field;
        }

        /**
         * Set the value of session_login_field
         */ 
        private function setSession_login_field($session_login_field)
        {
            $this->session_login_field = $session_login_field;
        }

        /**
         * Get the value of errors
         */ 
        public function getErrors()
        {
            return $this->errors;
        }

        /**
         * Set the value of errors
         */ 
        public function setErrors($errors)
        {
            $this->errors[] = $errors;
        }

        /**
         * Get the value of msgs
         */ 
        public function getMsgs()
        {
            return $this->msgs;
        }

        /**
         * Set the value of msgs
         */ 
        public function setMsgs($msgs)
        {
            $this->msgs = $msgs;
        }

        /**
         * Get the value of valido
         */ 
        public function getValido()
        {
            if($this->getValidation_check()){

                if(empty($this->getErrors())){

                    $this->setValido(true);

                }

            }
            return $this->valido;
        }

        /**
         * Set the value of valido
         */ 
        public function setValido($valido)
        {
            $this->valido = $valido;
        }

        /**
         * Get the value of validation_check
         */ 
        public function getValidation_check()
        {
            return $this->validation_check;
        }

        /**
         * Set the value of validation_check
         */ 
        public function setValidation_check($validation_check)
        {
            $this->validation_check = $validation_check;
        }
    }
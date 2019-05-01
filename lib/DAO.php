<?php

    require_once 'Banco.php';

    class DAO
    {
        protected static $tabela = 'teste';
        protected static $pk;

        /**
         * select all
         * @param array $order
         * exemplo 'ORDER BY DESC'
         */
        public function all($orderby = null)
        {
            try{

                $sql = "SELECT * FROM ".self::$tabela;

                if(!is_null($orderby)){

                    if(count($orderby) == 1){

                        if(strtolower(reset($orderby)) == 'desc' ||  strtolower(reset($orderby)) == 'asc'){

                            $order = strtoupper(reset($orderby));

                            $sql .= ' ORDER BY '.key($orderby).' '.$order;

                        }

                    }

                }

                $stmt = Banco::getInstance()->query($sql);

                return $stmt->fetchAll();

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }

        /**
         * select all com condições
         * @param array $condicoes
         * @param array $orderby
         * exemplo ['nome = gabriel', 'idade = 19']
         */
        public function allWhere($condicoes, $orderby = null)
        {
            try{

                if(count($condicoes) >= 1){

                    $varias = implode(',', $condicoes);
                    $condicao = str_replace(',', ' AND ', $varias);

                }

                $sql = "SELECT * FROM ".self::$tabela." WHERE ".$condicao;

                if(!is_null($orderby)){

                    if(count($orderby) == 1){

                        if(strtolower(reset($orderby)) == 'desc' ||  strtolower(reset($orderby)) == 'asc'){

                            $order = strtoupper(reset($orderby));

                            $sql .= ' ORDER BY '.key($orderby).' '.$order;

                        }

                    }

                }

                $stmt = Banco::getInstance()->query($sql);
                
                return $stmt->fetchAll();

                echo $sql;

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }

        /**
         * select one
         * @param int|string $id
         */
        public function find($id)
        {
            try{

                $sql = "SELECT * FROM ".self::$tabela." WHERE ".self::$pk." = :id";
                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->execute();

                return $stmt->fetch();

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }

        /**
         * select one where
         * @param int|string $id
         * @param array $condicoes
         */
        public function findWhere($id, $condicoes)
        {
            try{

                if(count($condicoes) >= 1){

                    $varias = implode(',', $condicoes);
                    $condicao = str_replace(',', ' AND ', $varias);

                }

                $sql = "SELECT * FROM ".self::$tabela." WHERE ".self::$pk." = :id AND ".$condicao;
                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->execute();

                return $stmt->fetch();

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }

        /**
         * select fields
         * @param array $fields
         * @param array $orderby
         */
        public function allFields($fields, $orderby = null)
        {
            try{

                if(count($fields) > 1){

                    $field = implode(',',$fields);

                }

                $sql = "SELECT $field FROM ".self::$tabela;

                if(!is_null($orderby)){

                    if(count($orderby) == 1){

                        if(strtolower(reset($orderby)) == 'desc' ||  strtolower(reset($orderby)) == 'asc'){

                            $order = strtoupper(reset($orderby));

                            $sql .= ' ORDER BY '.key($orderby).' '.$order;

                        }

                    }

                }

                $stmt = Banco::getInstance()->query($sql);

                return $stmt->fetchAll();

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }

        /**
         * select fields where
         * @param array $fields
         * @param array $condicoes
         * @param array $orderby
         */
        public function allFieldsWhere($fields, $condicoes, $orderby = null)
        {
            try{

                if(count($fields) > 1){

                    $field = implode(',',$fields);

                }

                if(count($condicoes) >= 1){

                    $varias = implode(',', $condicoes);
                    $condicao = str_replace(',', ' AND ', $varias);

                }

                $sql = "SELECT $field FROM ".self::$tabela." WHERE ".$condicao;

                if(!is_null($orderby)){

                    if(count($orderby) == 1){

                        if(strtolower(reset($orderby)) == 'desc' ||  strtolower(reset($orderby)) == 'asc'){

                            $order = strtoupper(reset($orderby));

                            $sql .= ' ORDER BY '.key($orderby).' '.$order;

                        }

                    }

                }

                $stmt = Banco::getInstance()->query($sql);

                return $stmt->fetchAll();

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }

        /**
         * select fields
         * @param array $fields
         * @param string|int $id
         */
        public function findFields($fields, $id)
        {
            try{

                if(count($fields) > 1){

                    $field = implode(',',$fields);

                }

                $sql = "SELECT $field FROM ".self::$tabela." WHERE ".self::$pk." = :id";
                $stmt = Banco::getInstance()->query($sql);
                $stmt->bindValue(':id', $id);

                return $stmt->fetch();

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }

        /**
         * select fields
         * @param array $fields
         * @param string|int $id
         * @param array $condicoes
         */
        public function findFieldsWhere($fields, $id, $condicoes)
        {
            try{

                if(count($fields) > 1){

                    $field = implode(',',$fields);

                }

                if(count($condicoes) >= 1){

                    $varias = implode(',', $condicoes);
                    $condicao = str_replace(',', ' AND ', $varias);

                }

                $sql = "SELECT $field FROM ".self::$tabela." WHERE ".self::$pk." = :id AND ".$condicao;
                $stmt = Banco::getInstance()->query($sql);
                $stmt->bindValue(':id', $id);

                return $stmt->fetch();

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }

        /**
         * delete
         * @param int|string $id
         */
        public function del($id)
        {
            try{

                $sql = "DELETE FROM ".self::$tabela." WHERE ".self::$pk." = :id";
                $stmt = Banco::getInstance()->prepare($sql);
                $stmt->bindValue(':id', $id);

                return $stmt->execute();

            }catch(PDOException $th){

                echo $th->getMessage();

            }
        }
    }
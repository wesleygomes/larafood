<?php

namespace App\Enums;

enum UserStatus: string
{
    // case ATIVO = 'Y';
    // case INATIVO = 'N';

    public static function Ativo()
    {
        return 'Y';
    }
    public static function Inativo()
    {
        return 'N';
    }
    public static function _Default()
    {
        return self::Ativo();
    }
    public static function _Descricao($value)
    {
        switch ($value) {
            case self::Ativo():
                return "Ativo";
            case self::Inativo():
                return "Inativo";
        }
    }
    public static function _Descricao2($value)
    {
        switch ($value) {
            case self::Ativo(): {
                    $rs = array(
                        'status' => 1,
                        'label' => 'Ativo',
                        'class' => 'success',
                        'icon' => 'fa fa-check'
                    );
                }
                break;
            case self::Inativo(): {
                    $rs = array(
                        'status' => 2,
                        'label' => 'Inativo',
                        'class' => 'secondary',
                        'icon' => 'fa fa-trash'
                    );
                }
                break;
        }
        $rs['span'] = '<span class="btn btn-xs btn-' . $rs['class'] . '"><i class="' . $rs['icon'] . '"></i> ' . $rs['label'] . '</span>';

        return $rs;
    }
    public static function _Values()
    {
        $vobj = array();
        $vobj[] = array(self::Ativo(), self::_Descricao(self::Ativo()));
        $vobj[] = array(self::Inativo(), self::_Descricao(self::Inativo()));

        return $vobj;
    }
}

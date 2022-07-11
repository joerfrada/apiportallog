<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Log;

use App\Models\Menu;
use App\Models\Usuario;
use App\Models\UsuarioMenu;

class UsuarioController extends Controller
{
    public function login(Request $request) {
        $p_usuario = $request->get('usuario');
        $m_usuario = new Usuario();

        $users = DB::table('tb_app_usuarios')->where('usuario', $p_usuario)->get();

        if (!$users->isEmpty()) {
            $usuario = $m_usuario->getLoginUsuario($p_usuario);

            $m_menu = new Menu();
            $m_usuariomenu = new UsuarioMenu();

            $data = array();
            foreach ($usuario as $row) {
                $tmp = array();
                $tmp['usuario_id'] = $row->usuario_id;
                $tmp['usuario'] = $row->usuario;
                $tmp['nombre_completo'] = $row->nombre_completo;
                $tmp['avatar'] = $row->avatar;
                $tmp['correo_electronico'] = $row->correo_electronico;
                $tmp['tipo_perfil'] = $row->tipo_perfil;
                $tmp['menus'] = $m_menu->get_menu_id($m_usuariomenu->getUsuarioMenu($row->usuario_id));

                array_push($data, $tmp);
            }

            $user = Usuario::first();
            $token = JWTAuth::fromUser($user);

            $response = json_encode(array('result' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
            return response()->json(array('user' => $response, 'tipo' => 0, 'token' => $token));
        }
    }
}

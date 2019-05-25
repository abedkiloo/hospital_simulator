<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /*
     * @test register of user
     */

    public function testRegister()
    {
        //User's data
        $data = [
            'email' => 'test@gmail.com',
            'name' => 'Test',
            "phone_no" => "0704494517",
            'user_name' => "abedkiloo",
            'password' => 'secret1234',
        ];
//        $data = json_encode($data);
        $response = $this->withHeaders(["Content-Type" => "application/json"])
            ->json("POST", url('api/user'), $data);
        $response->assertStatus(200);

    }

    public function testLogin()
    {
        $data = [
            'grant_type' => "password",
            "client_id" => 2,
            "client_secret" => "cb2CMZKBlt1uy2iTkyxqMtDgdOThohHpupNyF0SW",
            "username" => "abedxh@gmail.com",
            "password" => "abedkiloo"
        ];
        $response = $this->withHeaders(["Content-Type" => "application/json"])
            ->json("POST", url('oauth/token'), $data);
        $response->assertStatus(200);
        //check for token
        //Assert we received a token
        $this->assertArrayHasKey('token', $response->json());
    }

}

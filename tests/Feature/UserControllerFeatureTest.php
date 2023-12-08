<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerFeatureTest extends TestCase
{
    use RefreshDatabase; // Para recriar o banco de dados a cada teste

    public function testStoreMethod()
    {
        // Dados de usuário simulados para o teste, incluindo a confirmação de senha
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret', // Adicione a confirmação de senha
        ];

        // Faça uma requisição POST para a rota de store
        $response = $this->post(route('users.store'), $userData);

        // Verifique se o usuário foi criado com sucesso
        $response->assertStatus(302); // Verifique se a resposta é um redirecionamento
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);

        // Verifique se a mensagem de sucesso está presente
        $response->assertSessionHas('success', 'Usuário criado com sucesso!');
    }

    public function testUpdateMethod()
    {
        // Crie um usuário simulado no banco de dados
        $user = User::factory()->create();


        // Dados de atualização simulados, incluindo a confirmação de senha
        $updatedUserData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword', // Adicione a confirmação de senha
        ];

        // Faça uma requisição PUT para a rota de update
        $response = $this->put(route('users.update', $user->id), $updatedUserData);

        // Verifique se o usuário foi atualizado com sucesso
        $response->assertStatus(302); // Verifique se a resposta é um redirecionamento
        $this->assertDatabaseHas('users', ['email' => 'updated@example.com']);

        // Verifique se a mensagem de sucesso está presente
        $response->assertSessionHas('success', 'Usuário atualizado com sucesso!');
    }

    public function testDestroyMethod()
    {
        // Crie um usuário simulado no banco de dados
        $user = User::factory()->create();

        // Faça uma requisição DELETE para a rota de destroy
        $response = $this->delete(route('users.destroy', $user->id));

        // Verifique se o usuário foi excluído com sucesso
        $response->assertStatus(302); // Verifique se a resposta é um redirecionamento
        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        // Verifique se a mensagem de sucesso está presente
        $response->assertSessionHas('success', 'Usuário excluído com sucesso!');
    }
}



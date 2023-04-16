@component('mail.mail-layout')

# Usuário criado com sucesso!

O seu usuário foi criado com sucesso {{ $userEmail }}.
Para acessar o site basta clicar aqui:
@component('mail::button', ['url' => 'www'])
    Visualizar site
@endcomponent

@endcomponent

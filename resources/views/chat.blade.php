@extends('layouts.base')

@section('title', 'Atención al cliente')

@section('menu')
    <style>
        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            color: rgb(205, 205, 205);
        }

        .chat-container {
            width: 1000px;
            height: 500px;
            border: 1px solid #ccc;
            /* overflow-y: scroll; */
            margin: 20px auto;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .chat-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .chat-message {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .chat-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-bubble {
            display: inline-block;
            max-width: 80%;
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
            line-height: 1.4;
        }

        .agent-message {
            background-color: #007bff;
            color: #fff;
        }

        .customer-message {
            background-color: #28a745;
            color: #fff;
        }

        .customer-message .chat-avatar {
            margin-right: auto;
            margin-left: 10px;
        }

        .customer-message .chat-bubble {
            text-align: right;
        }
    </style>

    <div class="chat-container">
        <div class="chat-title">Chat de atención al cliente</div>

        <!-- Mensaje de bienvenida del agente -->
        <div class="chat-message">
            <img src="{{ asset('img/atencionAlCliente.png') }}" alt="Agent Avatar" class="chat-avatar">
            <div class="chat-bubble agent-message">
                ¡Hola! ¿En qué puedo ayudarte hoy?
            </div>
        </div>
        <!-- Opciones de preguntas del cliente -->
        <div class="chat-message">
            <img src="{{ asset('img/userChat.png') }}" alt="Customer Avatar" class="chat-avatar" style="margin-left: auto;">
            <div class="chat-bubble customer-message">
                <a href="#" onclick="sendUserMessage('¿Tienen alguna promoción?')">¿Tienen alguna promoción?</a>
            </div>
        </div>
        <div class="chat-message">
            <img src="{{ asset('img/userChat.png') }}" alt="Customer Avatar" class="chat-avatar" style="margin-left: auto;">
            <div class="chat-bubble customer-message">
                <a href="#" onclick="sendUserMessage('¿Cuál es su horario de atención?')">¿Cuál es su horario de
                    atención?</a>
            </div>
        </div>
        <div class="chat-message">
            <img src="{{ asset('img/userChat.png') }}" alt="Customer Avatar" class="chat-avatar" style="margin-left: auto;">
            <div class="chat-bubble customer-message">
                <a href="#" onclick="sendUserMessage('¿Tienen servicio de entrega a domicilio?')">¿Tienen servicio de
                    entrega a domicilio?</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function sendUserMessage(message) {
            var chatContainer = $('.chat-container');
            var messageElement = $('<div>').addClass('chat-message');
            var avatarElement = $('<img>').attr('src', '{{ asset('img/userChat.png') }}').addClass('chat-avatar');
            var bubbleElement = $('<div>').addClass('chat-bubble').addClass('customer-message').text(message.trim());
            messageElement.append(avatarElement).append(bubbleElement);
            chatContainer.append(messageElement);
            chatContainer.scrollTop(chatContainer.prop('scrollHeight'));

            setTimeout(function() {
                var reply = getReply(message);
                sendMessage(reply, true);
            }, 1000);
        }

        function sendMessage(message, isAgent) {
            var chatContainer = $('.chat-container');
            var avatarClass = isAgent ? 'agent-avatar' : 'customer-avatar';
            var bubbleClass = isAgent ? 'agent-message' : 'customer-message';
            var messageElement = $('<div>').addClass('chat-message');
            var avatarElement = $('<img>').attr('src', '{{ asset('img/atencionAlCliente.png') }}').addClass('chat-avatar')
                .addClass(
                    avatarClass);
            var bubbleElement = $('<div>').addClass('chat-bubble').addClass(bubbleClass).text(message.trim());
            messageElement.append(avatarElement).append(bubbleElement);
            chatContainer.append(messageElement);
            chatContainer.scrollTop(chatContainer.prop('scrollHeight'));
        }

        function getReply(message) {
            switch (message.toLowerCase()) {
                case '¿tienen alguna promoción?':
                    return 'Sí, actualmente tenemos descuentos en vitaminas y suplementos. ¿Te gustaría saber más sobre alguna categoría en particular?';
                case '¿cuál es su horario de atención?':
                    return 'Nuestro horario de atención es de lunes a viernes de 9:00 am a 6:00 pm. ¿Hay algo más en lo que pueda ayudarte?';
                case '¿tienen servicio de entrega a domicilio?':
                    return 'Sí, ofrecemos servicio de entrega a domicilio. ¿Podrías proporcionarme tu dirección para verificar la disponibilidad en tu área?';
                default:
                    return 'Lo siento, no entiendo tu pregunta. Por favor, sé más específico o contáctanos directamente al número de atención al cliente.';
            }
        }
    </script>
@endsection

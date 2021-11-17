

@extends('layouts.app')
@section('stylesheet')
    
    
    
@endsection
@section('create')

    

@endsection
@section('content')

<div id="chat">
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>
    </div>
    <script src="https:/cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js">
    </script>
    <script src="https:/cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js">
    </script>
    <script>

        new Vue({
            el: '#chat',
            data: {
                message: ''
            }
            methods: {
                send() {

                    const url = '/ajax/chat';
                    const params = { message: this.message };
                    axios.post(url, params)
                        .then((response) => {

                            
                            this.message = '';

                });

        }
    }
        });

    </script>


@endsection

@if(count($errors) > 0)
    <template id="errors-message-template-swal">
        <swal-title>
            OH NO! You have the following @if(count($errors) > 1)errors @else error @endif</span>:
        </swal-title>
        <swal-icon type="error"></swal-icon>
        <swal-html>
            @foreach($errors->all() as $error)
                <div>
                    -{{$error}}
                </div>
            @endforeach
        </swal-html>
    </template>
    <script>
        $( document ).ready(function() {
            Swal.fire({
                template: "#errors-message-template-swal"
            })
        })
    </script>
@endif

@if(session('success'))
    <script>
        $( document ).ready(function() {
            Swal.fire(
                'Success!',
                '{{session("success")}}',
                'success'
            )
        })
    </script>
@endif

@if(session('error'))
    <script>
        $( document ).ready(function() {
            Swal.fire(
                'OH NO!',
                '{{session("error")}}',
                'error'
            )
        })
    </script>
@endif

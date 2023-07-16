const reply = document.querySelectorAll('.reply')
const replyBtn = document.querySelectorAll('.replyBtn')

replyBtn.forEach(button => {
    button.addEventListener('click', () => {
        const idReport = button.getAttribute('id-report');
        const textarea = document.querySelector(`textarea[id-report="${idReport}"]`);
        const textareaValue = textarea.value;

        if(!textareaValue) {
          return new Noty({
            type: 'error',
            text: 'Tanggapan harus diisi!',
            timeout: 2000,
          }).show();
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const data = {
            report_id: idReport,
            user_id,
            isi: textareaValue
        }

        $.ajax({
            url: '/chat',
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            data: JSON.stringify(data),
            dataType: 'json',
            success: function(response) {
                textarea.value = '';
                const chatsContainer = document.querySelector(`.chats-container[id-report="${idReport}"]`);
                const newElement = document.createElement('div');
                newElement.className = 'bg-[#173D7A] bg-opacity-10 p-3 rounded-md max-w-[90%] mb-3 self-end border-r-4 border-r-slate-300';
                newElement.textContent = textareaValue;
                chatsContainer.appendChild(newElement);

                new Noty({
                    type: 'success',
                    text: response,
                    timeout: 2000,
                }).show();
            },
            error: function(error) {
                console.error(error);
                new Noty({
                    type: 'error',
                    text: error.responseText,
                    timeout: 2000,
                }).show();
            }
        });
    });
});
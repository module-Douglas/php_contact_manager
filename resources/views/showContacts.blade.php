<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts</title>
  <style>

    body {
      font-family: 'JetBrains Mono';
      background-color: #181818;
      color: #aaaaaa;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0px 20px;
      background-color: #181818;
      color: #92ac68;
    }

    .container {
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 1200px;
      margin-top: 20px;
    }

    .containertwo {
      display: flex;
      justify-content: center;
    }

    #contact-list {
      list-style-type: none;
      padding: 0;
    }

    .contact-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #aaaaaa;
    }

    .contact- item span {
      flex: 1;
      text-align: left;
    }

    .contact-item .contact-name {
      flex: 2;
    }

    .contact-item .contact-email {
      flex: 3;
    }

    .contact-item .contact-phone {
      flex: 2;
    }

    .contact-item button,
    .contact-item form {
      margin-left: 10px;
    }

    .button {
      font-family: 'JetBrains Mono';
      font-size: 20px;
      
      padding: 10px 20px;
      background-color: #181818;
      color: #92ac68;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: transform 0.1s ease, background-color 0.1s ease;
    }

    .button:active {
      transform: scale(0.95);
      background-color: #2a2a2a;
    }

      /* Estilos para o modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.4);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .modal.show {
      display: block;
      opacity: 1;
    }

    .modal-content {
      background-color: #212121;
      margin: 15% auto;
      padding: 20px;
      border-radius: 5px;
      width: 80%;
      max-width: 500px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      transform: translateY(-50px);
      transition: transform 0.3s ease;
    }

    .modal.show .modal-content {
      transform: translateY(0);
    }

    #modal-title {
      font-size: 25px;
      margin: 10px;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .close {
      color: #aaaaaa;
      float: right;
      font-size: 40px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #c3352e;
      text-decoration: none;
      cursor: pointer;
    }

    .input {
      border-radius: 5px;
      background-color: #181818;
      width: 500px;
      height: 40px;
      color: #ffffff;
      font-size: 15px;
      text-align: left;
      padding-left: 10px;
      border: none;
      outline: none;
      box-shadow: none;
      font-family: 'JetBrains Mono';
    }

    .label {
      color: #aaaaaa;
      font-size: 18px;
      margin-bottom: 5px;
      margin-top: 10px;
      margin-left: 5px;
      font-family: 'JetBrains Mono';
    }

    .form-group {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
    }

    input:invalid {
      box-shadow: none;
    }

    input:invalid:focus {
      box-shadow: none;
      border-color: initial;
    }

    .error-message {
      display: none;
      color: #c3352e;
      margin-top: 10px;
      text-align: center;
    }

  </style>
</head>
<body>

  <body>
    <div class="top-bar">
      <h1>Contacts</h1>
      <form id="logout-form" action="{{ url("logout") }}" method="get" style="display: inline;">
        @csrf
        <button type="submit" class="button" id="logoutBtn">Logout</button>
      </form>
    </div>
    <div class="containertwo">
      <div class="container">
        <button id="openModalBtn" class="button">+ Add Contact</button>
        <ul id="contact-list">
          @foreach ($contacts as $contact)
            <li class="contact-item" id="contact-{{ $contact->id }}">
              <span class="contact-name">{{ $contact->name }}</span>
              <span class="contact-email">{{ $contact->email }}</span>
              <span class="contact-phone">{{ $contact->phone }}</span>
              <button class="edit-contact-btn button" data-id="{{ $contact->id }}" data-name="{{ $contact->name }}" data-email="{{ $contact->email }}" data-phone="{{ $contact->phone }}">Edit</button>
              <form class="delete-contact-form" data-id="{{ $contact->id }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="button" type="submit">Delete</button>
              </form>
            </li>
          @endforeach
        </ul>
      </div>
    </div>

  <!-- Modal -->
  <div id="addContactModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modal-title">Add Contact</h5>
        <span class="close">&times;</span>
      </div>
      <div id="error-message" class="error-message"></div>
      <form id="add-contact-form">
        <input type="hidden" id="contact-id">
        <div class="form-group">
          <label class="label" for="name">Name</label>
          <input class="input" type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
          <label class="label" for="email">Email</label>
          <input class="input" type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
          <label class="label" for="phone">Phone</label>
          <input class="input" type="text" class="form-control" id="phone" name="phone">
        </div>
        <button style="margin-top: 20px" class="button" type="submit" class="btn btn-primary">Save</button>
    </form>
    </div>
  </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
          var modal = document.getElementById('addContactModal');
          var openModalBtn = document.getElementById('openModalBtn');
          var closeModalBtn = document.getElementsByClassName('close')[0];
          var modalTitle = document.getElementById('modal-title');
          var contactIdInput = document.getElementById('contact-id');
          var addContactForm = document.getElementById('add-contact-form');
          var errorMessage = document.getElementById('error-message');
          var phoneInput = document.getElementById('phone');
  
          openModalBtn.onclick = function() {
            modalTitle.textContent = 'Add Contact';
            contactIdInput.value = '';
            addContactForm.reset();
            modal.style.display = 'block';
            setTimeout(function() {
                modal.classList.add('show');
            }, 10);
          }
  
          closeModalBtn.onclick = function() {
            errorMessage.style.display = 'none'
            modal.classList.remove('show');
            setTimeout(function() {
                modal.style.display = 'none';
            }, 300);
          }
  
          window.onclick = function(event) {
            if (event.target == modal) {
              errorMessage.style.display = 'none'
              modal.classList.remove('show');
              setTimeout(function() {
                modal.style.display = 'none';
              }, 300);
            }
          }
  
          addContactForm.onsubmit = function(e) {
            e.preventDefault();

            var contactId = contactIdInput.value;
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;

            if(!name) {
              errorMessage.textContent = "Name field is needed, please fill it.";
              errorMessage.style.display = 'block';
              return;
            }

            if (!phone && !email) {
              errorMessage.textContent = "Please fill in at least one field: phone or email.";
              errorMessage.style.display = 'block';
              return;
            }

            errorMessage.style.display = 'none';

            var formData = new FormData();
            formData.append('name', name);
            formData.append('email', email ? email : '');
            formData.append('phone', phone ? phone : '');
            formData.append('_token', '{{ csrf_token() }}');

            var url = contactId ? `/contacts/${contactId}` : '{{ url("contacts") }}';
            var method = 'POST';

            fetch(url, {
              method: method,
              headers: {
                  '-CSRF-TOKEN': '{{ csrf_token() }}',
                  'X-HTTP-Method-Override': method
              },
              body: formData
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                if (contactId) {
                  var contactItem = document.getElementById(`contact-${contactId}`);
                  contactItem.innerHTML = `
                    <span class="contact-name">${data.contact.name}</span>
                    <span class="contact-email">${data.contact.email !== null ? data.contact.email : ''}</span>
                    <span class="contact-phone">${data.contact.phone !== null ? data.contact.phone : ''}</span>
                    <button class="edit-contact-btn button" data-id="${data.contact.id}" data-name="${data.contact.name}" data-email="${data.contact.email !== null ? data.contact.email : ''}" data-phone="${data.contact.phone !== null ? data.contact.phone : ''}">Edit</button>
                    <form class="delete-contact-form" data-id="${data.contact.id}" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button class="button" type="submit">Delete</button>
                    </form>
                  `;
                } else {
                  var contactList = document.getElementById('contact-list');
                  var newContact = document.createElement('li');
                  newContact.classList.add('contact-item');
                  newContact.id = `contact-${data.contact.id}`;
                  newContact.innerHTML = `
                    <span class="contact-name">${data.contact.name}</span>
                    <span class="contact-email">${data.contact.email !== null ? data.contact.email : ''}</span>
                    <span class="contact-phone">${data.contact.phone !== null ? data.contact.phone : ''}</span>
                    <button class="edit-contact-btn button" data-id="${data.contact.id}" data-name="${data.contact.name}" data-email="${data.contact.email !== null ? data.contact.email : ''}" data-phone="${data.contact.phone !== null ? data.contact.phone : ''}">Edit</button>
                    <form class="delete-contact-form" data-id="${data.contact.id}" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button class="button" type="submit">Delete</button>
                    </form>
                  `;
                  contactList.appendChild(newContact);
                }

                modal.classList.remove('show');
                setTimeout(function() {
                    modal.style.display = 'none';
                }, 300);
              } else {
                  alert('Erro ao adicionar/atualizar contato');
              }
            })
            .catch(error => {
              console.error('Erro:', error);
              alert('Erro ao adicionar/atualizar contato');
            });
          }
  
          document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('edit-contact-btn')) {
              var contactId = e.target.getAttribute('data-id');
              var name = e.target.getAttribute('data-name');
              var email = e.target.getAttribute('data-email');
              var phone = e.target.getAttribute('data-phone');

              modalTitle.textContent = 'Edit Contact';
              contactIdInput.value = contactId;
              document.getElementById('name').value = name;
              document.getElementById('email').value = email;
              document.getElementById('phone').value = phone;

              modal.style.display = 'block';
              setTimeout(function() {
                  modal.classList.add('show');
              }, 10);
            }
          });
  
          document.addEventListener('submit', function(e) {
            if (e.target && e.target.classList.contains('delete-contact-form')) {
              e.preventDefault();

              var contactId = e.target.getAttribute('data-id');
              var formData = new FormData(e.target);

              fetch(`/contacts/${contactId}`, {
                method: 'DELETE',
                body: formData
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  var contactItem = document.getElementById(`contact-${contactId}`);
                  contactItem.remove();
                } else {
                  alert('Erro ao deletar contato');
                }
              })
              .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao deletar contato');
              });
            }
          });

          function formatPhone(value) {
            value = value.replace(/\D/g, '');
            value = value.substring(0, 11);
            value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
            value = value.replace(/(\d)(\d{4})$/, '$1-$2');
            return value;
          }

          phoneInput.addEventListener('input', function(e) {
            e.target.value = formatPhone(e.target.value);
          });
      });
  </script>
</body>
</html>
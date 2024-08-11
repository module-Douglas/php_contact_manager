<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <style>
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
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            transform: translateY(-50px);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contacts</h1>
        <button id="openModalBtn" class="btn btn-primary">Add Contact</button>
        <ul id="contact-list">
            @foreach ($contacts as $contact)
                <li id="contact-{{ $contact->id }}">
                    {{ $contact->name }} - {{ $contact->email }} - {{ $contact->phone }}
                    <button class="edit-contact-btn" data-id="{{ $contact->id }}" data-name="{{ $contact->name }}" data-email="{{ $contact->email }}" data-phone="{{ $contact->phone }}">Edit</button>
                    <form class="delete-contact-form" data-id="{{ $contact->id }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Modal -->
    <div id="addContactModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h5 id="modal-title">Add Contact</h5>
            <form id="add-contact-form">
                <input type="hidden" id="contact-id">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
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
  
          openModalBtn.onclick = function() {
              modalTitle.textContent = 'Add Contact';
              contactIdInput.value = '';
              addContactForm.reset();
              modal.style.display = 'block';
              setTimeout(function() {
                  modal.classList.add('show');
              }, 10); // Pequeno atraso para permitir a transição
          }
  
          closeModalBtn.onclick = function() {
              modal.classList.remove('show');
              setTimeout(function() {
                  modal.style.display = 'none';
              }, 300); // Tempo da transição
          }
  
          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.classList.remove('show');
                  setTimeout(function() {
                      modal.style.display = 'none';
                  }, 300); // Tempo da transição
              }
          }
  
          addContactForm.onsubmit = function(e) {
              e.preventDefault();
  
              var contactId = contactIdInput.value;
              var name = document.getElementById('name').value;
              var email = document.getElementById('email').value;
              var phone = document.getElementById('phone').value;
  
              var formData = new FormData();
              formData.append('name', name);
              formData.append('email', email);
              formData.append('phone', phone);
              formData.append('_token', '{{ csrf_token() }}'); // Adiciona o token CSRF
  
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
                              ${data.contact.name} - ${data.contact.email} - ${data.contact.phone}
                              <button class="edit-contact-btn" data-id="${data.contact.id}" data-name="${data.contact.name}" data-email="${data.contact.email}" data-phone="${data.contact.phone}">Edit</button>
                              <form class="delete-contact-form" data-id="${data.contact.id}" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Delete</button>
                              </form>
                          `;
                      } else {
                          var contactList = document.getElementById('contact-list');
                          var newContact = document.createElement('li');
                          newContact.id = `contact-${data.contact.id}`;
                          newContact.innerHTML = `
                              ${data.contact.name} - ${data.contact.email} - ${data.contact.phone}
                              <button class="edit-contact-btn" data-id="${data.contact.id}" data-name="${data.contact.name}" data-email="${data.contact.email}" data-phone="${data.contact.phone}">Edit</button>
                              <form class="delete-contact-form" data-id="${data.contact.id}" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Delete</button>
                              </form>
                          `;
                          contactList.appendChild(newContact);
                      }
  
                      modal.classList.remove('show');
                      setTimeout(function() {
                          modal.style.display = 'none';
                      }, 300); // Tempo da transição
                      addContactForm.reset();
                  } else {
                      alert('Erro ao adicionar/atualizar contato');
                  }
              })
              .catch(error => {
                  console.error('Erro:', error);
                  alert('Erro ao adicionar/atualizar contato');
              });
          }
  
          // Event listener para editar contato
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
                  }, 10); // Pequeno atraso para permitir a transição
              }
          });
  
          // Event listener para deletar contato
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
      });
  </script>
</body>
</html>
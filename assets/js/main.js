  let idClick = document.getElementById('idClick');
  let effectClick = document.getElementById('effectClick');
  let idArrow = document.getElementById('arrow');
  let container = document.getElementById('container');

  let account = 0;

  idClick.onclick = function () {
      effect()
  };

  let width = (window.innerWidth);
  let height = (window.innerHeight);

  if (width < 768) {
      container.classList.add('mrsmall');
      effectClick.classList.add('collapsed');
      idArrow.classList.add('fa-angle-right');
  } else {
      container.classList.add('mrbig');
  }

  function effect() {
      if (account == 0) {
          account++;
          container.classList.remove('mrbig');
          container.classList.add('mrsmall');
          effectClick.classList.add('collapsed');
          idArrow.classList.remove('fa-angle-left');
          idArrow.classList.add('fa-angle-right');
          return account;
      } else {
          container.classList.add('mrbig');
          container.classList.remove('mrsmall');
          effectClick.classList.remove('collapsed');
          idArrow.classList.add('fa-angle-left');
          idArrow.classList.remove('fa-angle-right');
          account = 0;
          return account;
      }
  }
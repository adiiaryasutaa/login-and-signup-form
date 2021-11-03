// sessionStorage.setItem('hasTriedToSubmit', 'false');

function formError(formId, message) {
  const form = document.getElementById(formId);
  form.children[0].classList.replace('border', 'border-2');
  form.children[0].classList.replace('border-transparent', 'border-red-500');
  form.children[0].classList.replace('focus:ring-blue-600', 'focus:ring-red-600');
  try {
    form.children[1].classList.remove('hidden');
    form.children[1].innerHTML = message;
  } catch (error) { }
}

// const inputs = document.querySelectorAll('input');
// const lastValue;

// inputs.forEach(e => {
//   e.addEventListener('focusin', () => {
//     lastValue = e.value;
//     form.children[0].classList.replace('border-2', 'border');
//     form.children[0].classList.replace('border-red-500', 'border-transparent');
//     form.children[0].classList.replace('focus:ring-red-600', 'focus:ring-blue-600');
//     form.children[1].classList.add('hidden');
//   }, sessionStorage.getItem('hasTriedToSubmit') === 'true');

//   e.addEventListener('focusout', () => {
//     form.children[0].classList.replace('border', 'border-2');
//     form.children[0].classList.replace('border-transparent', 'border-red-500');
//     form.children[0].classList.replace('focus:ring-blue-600', 'focus:ring-red-600');
//     try {
//       form.children[1].classList.remove('hidden');
//       form.children[1].innerHTML = message;
//     } catch (error) { }
//   }, lastValue == e.value && sessionStorage.getItem('hasTriedToSubmit') === 'true');
// });

// const submitBtn = document.querySelector('button.submit-btn');

// submitBtn.addEventListener('click', () => {
//   sessionStorage.setItem('hasTriedToSubmit', 'true');
// });

// inputs.forEach(e => {
//   const lastValue = e.value;
//   e.addEventListener('input', () => {
//     if (lastValue != e.value) {
//       form.children[0].classList.replace('border-2', 'border');
//       form.children[0].classList.replace('border-red-500', 'border-transparent');
//       form.children[0].classList.replace('focus:ring-red-600', 'focus:ring-blue-600');
//       form.children[1].classList.add('hidden');
//     }
//   });
// });


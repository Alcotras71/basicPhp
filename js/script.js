"use strict";

window.addEventListener('DOMContentLoaded', function () {

	try{
		const btns = document.querySelectorAll('.footer-content__button'),
			btnsParent = document.querySelector('.footer-content');
		let btnActive;

		if (localStorage.getItem('btn')) {
			btnActive = localStorage.getItem('btn');
		} else {
			btnActive = 0;
			localStorage.setItem('btn', btnActive);
		}

		const hideActive = function () {
			btns.forEach(btn => {
				btn.classList.remove('active');
			});
		};

		const addActive = function(i) {
			btns[i].classList.add('active');
		};

		hideActive();
		addActive(btnActive);

		btnsParent.addEventListener('click', (e) => {
			if (e.target && e.target.getAttribute('data-active')) {
				localStorage.setItem('btn', +e.target.getAttribute('data-active'));
			}
		});
	} 
	catch (e) {
		console.log(e);
	} 
	

	try {
		const btnReturn = document.querySelector('.footer-content__return a');
		console.log(btnReturn);
		btnReturn.addEventListener('click', (e) => {
			if (e.target) {
				localStorage.setItem('btn', 0);
			}
		});
	}
	catch (e) {
		console.log(e);
	} 
});































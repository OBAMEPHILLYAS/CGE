$(document).ready(function(){
	$("#form_login").validate({
		rules: {
			login: (
				required: true,
				minlength: 3,
				)
			password: (
				required: true,
				minlength: 3,
				)
		},
		message: (
			login: (
				required: "le champ 'login' est requis",
				minlength: "votre login doit faire au moins{0} caractères",
				)
			password: (
				required: "le champ 'password' est requis",
				minlength: "votre mot de passe doit faire au moins{0} caractères",
				)
		)
	});
});
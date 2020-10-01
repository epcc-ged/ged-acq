$(document).ready(function(){
	// Au chargement : on bloque la select box des segments 
	$('#filtre_segment').prop("disabled", true);

	$('#filtre_segment').on('change', function () {
		// Cas où un segment précis est choisi
		if ($(this).val() != "Tous"){
			// On affiche uniquement le segment choisi
			$(".segment").hide();
			$(".segment." + $(this).val()).show();
		} else {
			// Tous les segments doivent être affichés...
			// Soit pour tous les territoires
			// Soit pour un territoire donné
			if ($('#filtre_territoire').val() == "Tous") {
				$(".segment").show();
			}
			else {
				$(".segment").hide();
				$territoire = $('#filtre_territoire').val();
				$('[class^=".segment.' + $territoire + '"]').show();
			}
		}
	});

	$('#filtre_territoire').on('change', function () {
		$territoire = $(this).val();
		if ($territoire == "Tous") {
			// On ne montre pas la liste des segments : on les affiche tous
			// pour tous les territoires.
			$('#filtre_segment').prop("disabled", true);
			// Et tous les résultats sont affichés
			$(".segment").show();
		} else {
			// On ne montre que les valeurs d'options de segments associés au territoire
			$('#filtre_segment option:selected').prop("selected", false);
			$('#filtre_segment').prop("disabled", false);
			$('#filtre_segment option').each(function(){
				if ($(this).val().substr(0,1) == $territoire) {
					$(this).prop('disabled', false);
					$(this).show();
				} else {
					$(this).prop('disabled', true);
					$(this).hide();
				}
			});
			// Par défaut, on laisse "Tous" actif et on le sélectionne
			$(".segment").hide();
			$('#filtre_segment option[value="Tous"]').show();
			$('#filtre_segment option[value="Tous"]').prop('disabled', false);
			$('#filtre_segment option[value="Tous"]').prop('selected', true);
			$('[class^=".segment.' + $territoire + '"]').show();
			// On cache toute la liste de résultat en attendant que l'utilisateur
			// ait fait son choix.
		}
	});
});


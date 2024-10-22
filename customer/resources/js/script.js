$(document).ready(function()
{
	const QUERY_TYPE =
	{
		FOODS: 0,
		FOODS_SUBTYPES: 1,
		DRINKS: 2
	};

	function resetNavBarButtons()
	{
		$("body header a").removeClass("active");
		$("html, body").animate({ scrollTop: 0 }, 20);
	}

	function toggleVisibility(selector, show)
	{
		$(selector).toggleClass("hidden", !show);
	}

	function updateButtonState(button, selected)
	{
		button.toggleClass("button-selected", selected).toggleClass("button-unselected", !selected);
	}

	function pageHome()
	{
		resetNavBarButtons();

		$("body header a[href='#home']").addClass("active");

		// Make sure reset the hash if page address is not valid
		window.location.hash = "#home";

		toggleVisibility("body .page-contents .home .left a.button.whatsapp", false);
		toggleVisibility("body .page-contents .home .left a.button.menu", true);
		enabledPageHome(1);
	}

	function disabledPageHome()
	{
		toggleVisibility("body .page-contents .home", false);
		toggleVisibility("body .page-contents .about", false);
		toggleVisibility("body .page-contents .best-menu", false);
	}

	function enabledPageHome(flags)
	{
		toggleVisibility("body .page-contents .home", true);
		toggleVisibility("body .page-contents .page-menu", false);

		if (flags === 1)
		{
			toggleVisibility("body .page-contents .about", true);
			toggleVisibility("body .page-contents .best-menu", true);
		}
	}

	function pageMenuQueries(type, subtype = 0)
	{
		const foodsButton = $("body .page-contents .page-menu .selections a.button.button-foods");
		const drinksButton = $("body .page-contents .page-menu .selections a.button.button-drinks");
		const subSelections = $("body .page-contents .page-menu .sub-selections");
		const isHidden = subSelections.hasClass("hidden");

		if (type === QUERY_TYPE.FOODS)
		{
			updateButtonState(foodsButton, true);
			toggleVisibility(subSelections, true);
			updateButtonState(drinksButton, false);
		}
		else if (type === QUERY_TYPE.DRINKS)
		{
			updateButtonState(foodsButton, false);
			toggleVisibility(subSelections, false);
			updateButtonState(drinksButton, true);
			toggleVisibility("body .page-menu .selections a.button.button-foods span#1", false);
			toggleVisibility("body .page-menu .selections a.button.button-foods span#2", true);
		}
		else if (type === QUERY_TYPE.FOODS_SUBTYPES)
		{
			toggleVisibility(subSelections, isHidden);
			toggleVisibility("body .page-menu .selections a.button.button-foods span#1", isHidden);
			toggleVisibility("body .page-menu .selections a.button.button-foods span#2", !isHidden);
		}

		for (let i = 1; i <= 4; i++)
		{
			const button = $(`body .page-menu .sub-selections a.button.button-foods#foods-subtype-button-${i}`);
			const buttonSelected = $(`body .page-menu .sub-selections a.button.button-foods#foods-subtype-button-${subtype}`);

			updateButtonState(button, false);
			updateButtonState(buttonSelected, true);
		}
	}

	function pageMenu(url)
	{
		const queryIndex = url.indexOf("?query=");

		resetNavBarButtons();

		$("body header a[href='#menu']").addClass("active");

		disabledPageHome();

		toggleVisibility("body .page-contents .page-menu", true);

		$(".page-menu .selections a.button.button-foods").off("click").on("click", function()
		{
			pageMenuQueries(QUERY_TYPE.FOODS_SUBTYPES);
		});

		if (queryIndex !== -1)
		{
			const queryValue = url.substring(queryIndex + 7);

			if (queryValue === "drinks")
			{
				pageMenuQueries(QUERY_TYPE.DRINKS);
			}
			else
			{
				const queryFoodIndex = url.indexOf("?query=foods&subtype=");

				if (queryFoodIndex !== -1)
				{
					const queryFoodValue = url.substring(queryFoodIndex + 21);
					pageMenuQueries(QUERY_TYPE.FOODS, queryFoodValue);
				}
				else
				{
					pageMenuQueries(QUERY_TYPE.FOODS);
					pageMenuQueries(QUERY_TYPE.FOODS_SUBTYPES);
				}
			}
		}
		else
		{
			pageMenuQueries(QUERY_TYPE.FOODS);
			pageMenuQueries(QUERY_TYPE.FOODS_SUBTYPES);
		}
	}

	function pageContact()
	{
		resetNavBarButtons();

		$("body header a[href='#contact']").addClass("active");

		toggleVisibility("body .page-contents .home .left a.button.menu", false);
		toggleVisibility("body .page-contents .home .left a.button.whatsapp", true);

		disabledPageHome();
		enabledPageHome(0);
	}

	function checkHash()
	{
		const currentHash = window.location.hash;

		if (currentHash === "#menu" || /^#menu(\?query=.*)?$/.test(currentHash))
			pageMenu(currentHash);
		else if (currentHash === "#contact")
			pageContact();
		else
			pageHome();
	}

	checkHash();

	$(window).on("hashchange", function()
	{
		checkHash();
	});
});
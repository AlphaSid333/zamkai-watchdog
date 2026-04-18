function searchTrustedAdmins( searchTerm ) {
	const dropdown = document.getElementById( 'trusted-admin-results' );

	if ( searchTerm.length < 2 ) {
		dropdown.innerHTML = '';
		dropdown.style.display = 'none';
		return;
	}

	fetch( zkWatchdog.ajaxUrl, {
		method: 'POST',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
		body: new URLSearchParams( {
			action:   'zk_search_trusted_admins',
			nonce:    zkWatchdog.nonce,
			search:   searchTerm,
		} ),
	} )
		.then( ( res ) => res.json() )
		.then( ( data ) => {
			dropdown.innerHTML = '';

			if ( ! data.success || data.data.length === 0 ) {
				dropdown.innerHTML = '<div class="zk-result-item zk-no-results">No users found.</div>';
				dropdown.style.display = 'block';
				return;
			}

			data.data.forEach( ( user ) => {
				const item = document.createElement( 'div' );
				item.className = 'zk-result-item';
				item.textContent = user.display_name + ' (' + user.email + ')';
				item.dataset.userId    = user.id;
				item.dataset.userName  = user.display_name;
				item.dataset.userEmail = user.email;

				item.addEventListener( 'click', () => {
					document.getElementById( 'trusted-admin-search' ).value = user.display_name;
					dropdown.innerHTML = '';
					dropdown.style.display = 'none';
					// TODO: populate a hidden field or trigger your add logic here
				} );

				dropdown.appendChild( item );
			} );

			dropdown.style.display = 'block';
		} )
		.catch( () => {
			dropdown.innerHTML = '<div class="zk-result-item zk-no-results">Search failed. Please try again.</div>';
			dropdown.style.display = 'block';
		} );
}
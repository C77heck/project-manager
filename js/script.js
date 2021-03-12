
const deleteAsync = async (id) => {
    // gets confirmation
    if (confirm('Biztos hogy törölni akarod?')) {
        try {
            const responseData = await fetch(
                'http://localhost/projects/delete.php', {
                method: 'DELETE',
                body: JSON.stringify({
                    id: id
                })
            }
            )
            console.log(responseData);
            // remove project visually
            document.querySelector(`.project${id}`).style.display = 'none'

        } catch (err) {
            alert('Törlés sikertelen. Kérlek próbáld meg késöbb.')
        }
    }
};

// form validation
$("#form").validate({
    rules: {
        title: {
            required: true
        },
        description: {
            required: true
        },
        owner_name: {
            required: true
        },
        owner_email: {
            required: true,
            email: true
        }
    },
    messages: {
        title: 'Ad meg a project nevét',
        description: 'Ad meg a project leírást',
        owner_name: 'Kérlek ad meg a kapcsolattartó nevét',
        owner_email: 'Kérlek adj meg egy létező e-mail címet'
    }
});
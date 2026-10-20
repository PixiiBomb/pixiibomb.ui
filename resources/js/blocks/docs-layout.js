const tableOfContents = document.getElementById('table-of-contents');
const queryHeaders = document.querySelectorAll('main h2');
const sections = document.querySelectorAll('section[id]');

const options = {
    root: null,
    rootMargin: "-20% 0px -60% 0px",
    threshold: 0
};

let activeLink = null;

// 2: Get headers on the page
if(queryHeaders.length > 0)
{
    queryHeaders.forEach((header) => {
        let value = header.textContent.trim();

        let lower = value.toLowerCase();
        let kebab = lower.replaceAll(' ', '-');

        const a = document.createElement('a');
        a.className = 'toc-link';
        a.href = `#${kebab.trim()}`;

        const li = document.createElement('li');
        li.textContent = value;

        tableOfContents.appendChild(a);
        a.appendChild(li);
    });
}

// 3. Create the observer callback function
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const id = entry.target.getAttribute("id");

            if (activeLink)
                activeLink.classList.remove("active");

            activeLink = document.querySelector(`.toc-link[href="#${id}"]`);
            activeLink.classList.add("active");
        }
    });
}, options);

// 4. Start tracking each section
sections.forEach((section) => observer.observe(section));

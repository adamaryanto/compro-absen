# DESIGN

Product: absenku company profile for an attendance and payroll system. Two surfaces: public landing page and admin panel.

Audience: HR admins, factory heads, owners, and operations staff in Indonesian manufacturing. Practical internal tooling, not consumer SaaS. Copy in plain Indonesian; demo figures are illustrative and should read as such.

Visual language: navy with a single calm blue accent, industrial but tidy. Archivo for display, Inter for body. Flat surfaces, no warm or orange hues.

Default tokens, all editable from the admin panel: primary #0B3D91, primary dark #061F4E, accent #FFC42E, ink #0E1A2B, paper #F4F3EF, line #E2E1DB, muted #5C6B80. Treat these as starting values, not a fixed brand; the site is white-label and the buyer supplies the company name and logo.

Composition: one focal point per section. Product proof is drawn in HTML and CSS (dashboard preview, phone check-in, payslip), not stock photography. Section rhythm varies with content instead of repeating a centered title above an identical card grid.

Motion: subtle scroll reveal only, with `prefers-reduced-motion` respected. No loops, parallax, or choreography.

Dial: ENERGY 2 / RHYTHM 2 / MOTION 1

(function () {
  'use strict';

  var shell = document.getElementById('adminShell');
  var menuBtn = document.getElementById('adminMenuBtn');
  var overlay = document.getElementById('adminOverlay');

  function closeNav() {
    if (!shell) return;
    var wasOpen = shell.classList.contains('nav-open');
    shell.classList.remove('nav-open');
    if (menuBtn) {
      menuBtn.setAttribute('aria-expanded', 'false');
      menuBtn.setAttribute('aria-label', 'Buka menu');
    }
    if (wasOpen && menuBtn) menuBtn.focus();
  }

  if (shell && menuBtn) {
    menuBtn.addEventListener('click', function () {
      var open = shell.classList.toggle('nav-open');
      menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      menuBtn.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
    });

    if (overlay) overlay.addEventListener('click', closeNav);

    var sidebarClose = document.getElementById('adminSidebarClose');
    if (sidebarClose) sidebarClose.addEventListener('click', closeNav);

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') closeNav();
    });

    document.querySelectorAll('.admin-sidebar a').forEach(function (link) {
      link.addEventListener('click', closeNav);
    });
  }

  /* Tabs -------------------------------------------------------------- */

  var tabs = Array.prototype.slice.call(document.querySelectorAll('.tab[data-tab]'));
  var panels = Array.prototype.slice.call(document.querySelectorAll('.tab-panel[data-panel]'));

  function activateTab(name) {
    tabs.forEach(function (tab) {
      var active = tab.getAttribute('data-tab') === name;
      tab.classList.toggle('is-active', active);
      tab.setAttribute('aria-selected', active ? 'true' : 'false');
    });

    panels.forEach(function (panel) {
      panel.classList.toggle('is-active', panel.getAttribute('data-panel') === name);
    });
  }

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      activateTab(tab.getAttribute('data-tab'));
    });
  });

  if (tabs.length) {
    var errorPanel = panels.filter(function (panel) {
      return panel.querySelector('.field-error');
    })[0];

    if (errorPanel) {
      activateTab(errorPanel.getAttribute('data-panel'));
    }
  }

  /* Colour pickers + live preview ------------------------------------ */

  var frame = document.getElementById('sitePreview');
  var frameWrap = document.querySelector('.preview-frame');
  var map = {
    color_primary: '--c-primary',
    color_primary_dark: '--c-primary-dark',
    color_accent: '--c-accent',
    color_ink: '--c-ink',
    color_paper: '--c-paper',
    color_line: '--c-line',
    color_muted: '--c-muted'
  };

  function frameRoot() {
    if (!frame || !frame.contentDocument) return null;
    return frame.contentDocument.documentElement;
  }

  function applyPreview(key, value) {
    var variable = map[key];
    var root = frameRoot();
    if (!variable || !root) return;
    root.style.setProperty(variable, value);
  }

  document.querySelectorAll('[data-color-row]').forEach(function (row) {
    var picker = row.querySelector('[data-color-input]');
    var hex = row.querySelector('[data-color-hex]');
    if (!picker || !hex) return;

    var key = hex.getAttribute('data-preview');

    picker.addEventListener('input', function () {
      hex.value = picker.value.toUpperCase();
      applyPreview(key, picker.value);
    });

    hex.addEventListener('input', function () {
      var value = hex.value.trim();
      if (/^#[0-9a-fA-F]{6}$/.test(value)) {
        picker.value = value;
        applyPreview(key, value);
      }
    });
  });

  var logoInput = document.querySelector('input[name="logo"][type="file"]');
  var logoUrl = null;

  function applyLogoPreview() {
    var doc = frame && frame.contentDocument ? frame.contentDocument : null;
    if (!doc || !logoUrl) return;

    doc.querySelectorAll('.brand-mark img').forEach(function (img) {
      if (img.getAttribute('src') !== logoUrl) img.setAttribute('src', logoUrl);
    });

    var icon = doc.querySelector('link[rel="icon"]');
    if (icon) icon.setAttribute('href', logoUrl);
  }

  if (logoInput) {
    logoInput.addEventListener('change', function () {
      if (logoUrl) URL.revokeObjectURL(logoUrl);
      logoUrl = null;
      if (logoInput.files && logoInput.files[0]) {
        logoUrl = URL.createObjectURL(logoInput.files[0]);
        applyLogoPreview();
      }
    });
  }

  function syncPreview() {
    document.querySelectorAll('[data-color-hex]').forEach(function (hex) {
      var key = hex.getAttribute('data-preview');
      var value = hex.value.trim();
      if (key && /^#[0-9a-fA-F]{6}$/.test(value)) applyPreview(key, value);
    });
    applyLogoPreview();
  }

  if (frame) frame.addEventListener('load', syncPreview);
  syncPreview();

  document.querySelectorAll('[data-preview-size]').forEach(function (button) {
    button.addEventListener('click', function () {
      document.querySelectorAll('[data-preview-size]').forEach(function (other) {
        var active = other === button;
        other.classList.toggle('is-active', active);
        other.setAttribute('aria-pressed', active ? 'true' : 'false');
      });
      if (frameWrap) {
        frameWrap.classList.toggle('is-mobile', button.getAttribute('data-preview-size') === 'mobile');
      }
    });
  });

  var reload = document.getElementById('previewReload');
  if (reload && frame) {
    reload.addEventListener('click', function () {
      frame.contentWindow.location.reload();
    });
  }

  /* Confirm destructive actions -------------------------------------- */

  document.querySelectorAll('form[data-confirm]').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!window.confirm(form.getAttribute('data-confirm'))) {
        event.preventDefault();
      }
    });
  });

  /* File input label ------------------------------------------------ */

  document.querySelectorAll('.file-input input[type="file"]').forEach(function (input) {
    input.addEventListener('change', function () {
      var label = input.closest('.file-input');
      if (!label) return;
      var textNode = Array.prototype.slice.call(label.childNodes).filter(function (node) {
        return node.nodeType === 3 && node.textContent.trim() !== '';
      })[0];
      if (textNode && input.files && input.files[0]) {
        textNode.textContent = ' ' + input.files[0].name;
      }
    });
  });
})();

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functional Tabs</title>
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-white dark:bg-gray-900">
<nav class="flex gap-x-0.5 md:gap-x-1" aria-label="Tabs" role="tablist">
    <button type="button" class="text-xs md:text-[13px] text-gray-800 border border-transparent hover:border-gray-400 font-medium rounded-md py-2 px-2.5 dark:text-neutral-200 dark:hover:text-white dark:hover:border-neutral-500 dark:bg-purple-600" id="validation-states-tab-preview-item" data-hs-tab="#validation-states-tab-preview" aria-controls="validation-states-tab-preview" role="tab" aria-selected="true">
        Preview
    </button>
    <button type="button" class="text-xs md:text-[13px] text-gray-800 border border-transparent hover:border-gray-400 font-medium rounded-md py-2 px-2.5 dark:text-neutral-200 dark:hover:text-white dark:hover:border-neutral-500" data-hs-tab="#validation-states-tab-html" aria-controls="validation-states-tab-html" role="tab" aria-selected="false">
        HTML
    </button>
</nav>

<div class="mt-3">
    <!-- Tab Content -->
    <div id="validation-states-tab-preview" role="tabpanel" aria-labelledby="validation-states-tab-preview-item">
        <h1 class="text-xl text-white">tab preview</h1>
    </div>
    <!-- End Tab Content -->

    <!-- Tab Content -->
    <div id="validation-states-tab-html" class="hidden" role="tabpanel" aria-labelledby="validation-states-tab-html-item">
        <h1 class="text-xl text-white">tab html</h1>
    </div>
    <!-- End Tab Content -->
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabButtons = document.querySelectorAll('[role="tab"]');
    const tabPanels = document.querySelectorAll('[role="tabpanel"]');

    tabButtons.forEach(button => {
        button.addEventListener("click", () => {
            // Deactivate all tabs and panels
            tabButtons.forEach(btn => {
                btn.classList.remove("dark:bg-purple-600");
                btn.classList.remove("bg-purple-500");
                btn.setAttribute("aria-selected", "false");
            });
            tabPanels.forEach(panel => panel.classList.add("hidden"));

            // Activate the clicked tab and corresponding panel
            button.classList.add("dark:bg-purple-600");
            button.classList.add("bg-purple-500");
            button.setAttribute("aria-selected", "true");
            const tabPanel = document.querySelector(button.getAttribute("data-hs-tab"));
            tabPanel.classList.remove("hidden");
        });
    });

    // Activate the first tab by default
    tabButtons[0].click();
});
</script>
</body>
</html>

const dashboardSelectionHandler = () => {
    const dashboardContainer = document.getElementById('dashboard')

    if (!dashboardContainer) {
        return;
    }

    const dashboardContent = document.getElementById('dashboard-content')

    const dashboardTabElements = dashboardContent.getElementsByClassName('datalistEntry')

    Array.from(dashboardTabElements).forEach((tab) => {
        tab.classList.add('hidden')
    })

    /**
     * @param tabId {string}
     */
    function showTab(tabId) {
        Array.from(dashboardTabElements)
            .filter((element) => !element.classList.contains('hidden'))
            .forEach(element => element.classList.add('hidden'))

        Array.from(dashboardTabElements)
            .filter(element => element.id === tabId)
            .forEach(element => element.classList.remove('hidden'))
    }

    const currentTab = window.location.hash.replace('#', '');

    showTab(currentTab ?? 'projects')

    addEventListener("hashchange", () => {
        showTab(window.location.hash.replace('#', ''))
    });
}

addEventListener('DOMContentLoaded', dashboardSelectionHandler)

import {getNextOuterClass, isEmpty, sleep} from "../utils.js";

const dashboardSelectionHandler = () => {
    class Navigationer {

        currentTab = ''
        previousTab = ''

        tabElements

        constructor(tabElements, initialTab) {
            this.tabElements = tabElements

            this.currentTab = initialTab
            this.previousTab = initialTab

            this.hideAllTabs()
            this.showTab(initialTab)
        }

        changeToTab(tab) {
            this.showTab(tab)

            this.previousTab = this.currentTab
            this.currentTab = tab
        }

        showTab(tabName) {
            Array.from(dashboardTabElements)
                .filter((element) => !element.classList.contains('hidden'))
                .forEach(element => element.classList.add('hidden'))

            Array.from(dashboardTabElements)
                .filter(element => element.id === tabName)
                .forEach(element => element.classList.remove('hidden'))

        }

        hideAllTabs() {
            Array.from(this.tabElements).forEach((tab) => {
                tab.classList.add('hidden')
            })
        }
    }

    const dashboardContainer = document.getElementById('dashboard')

    if (!dashboardContainer) {
        return;
    }

    const dashboardContent = document.getElementById('dashboard-content')

    const dashboardTabElements = dashboardContent.getElementsByClassName('datalistEntry')

    const Navigator = new Navigationer(dashboardTabElements, 'images')

    const dashboardSidebarLinks = document.getElementsByClassName('dashboard-sidebar-link')

    for (const dashboardSidebarLink of dashboardSidebarLinks) {
        dashboardSidebarLink.addEventListener('click', (event) => {
            event.preventDefault()

            const target = event.target
            const correctTarget = getNextOuterClass(target, 'dashboard-sidebar-link')

            Navigator.changeToTab(correctTarget.dataset.tab)
        })
    }

}

addEventListener('DOMContentLoaded', dashboardSelectionHandler)

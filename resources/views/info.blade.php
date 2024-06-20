<x-app-layout>
    <x-header :headerTitle="'Info'"></x-header>
    <x-container :title="'Info'">
        <x-paragraph>This system facilitates the management of project tasks while providing outside clients access to their respective projects.</x-paragraph>
        <br>
        <x-highlight-header>Features</x-highlight-header>
        <ul>
            <li><x-paragraph>User Authentication: Separate authentication systems for staff and clients.</x-paragraph></li>
            <li><x-paragraph>Project Management: Manage companies, projects, phases, and tasks.</x-paragraph></li>
            <li><x-paragraph>Bug Tracking: Log and track project-related bugs.</x-paragraph></li>
        </ul>
        <br>
        <x-highlight-header>MVP Phase</x-highlight-header>
        <x-paragraph>Currently in Phase One of our Minimum Viable Product (MVP), focusing on core functionalities.</x-paragraph>
    </x-container>
</x-app-layout>
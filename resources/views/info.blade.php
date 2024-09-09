<x-app-layout>
    <x-header :headerTitle="'Info'"></x-header>
    <x-container :title="'Info'">
        <x-fonts.paragraph>This system facilitates the management of project tasks while providing outside clients access to their respective projects.</x-fonts.paragraph>
        <br>
        <x-fonts.highlight-header>Features</x-fonts.highlight-header>
        <ul>
            <li><x-fonts.paragraph>User Authentication: Separate authentication systems for staff and clients.</x-fonts.paragraph></li>
            <li><x-fonts.paragraph>Project Management: Manage companies, projects, phases, and tasks.</x-fonts.paragraph></li>
            <li><x-fonts.paragraph>Bug Tracking: Log and track project-related bugs.</x-fonts.paragraph></li>
        </ul>
        <br>
        <x-fonts.highlight-header>MVP Phase</x-fonts.highlight-header>
        <x-fonts.paragraph>Currently in Phase One of our Minimum Viable Product (MVP), focusing on core functionalities.</x-fonts.paragraph>
    </x-container>
</x-app-layout>
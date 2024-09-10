<!DOCTYPE html>
<html lang="en">
<livewire:dashboard.configs.head />

<body class="light rtl">
<livewire:dashboard.configs.header />
<div>
    <livewire:dashboard.configs.header />
</div>
<livewire:dashboard.configs.sidebar />
<section class="content">
    <div class="container-fluid">
        {{$slot}}
    </div>
</section>
<livewire:dashboard.configs.foot />
</body>

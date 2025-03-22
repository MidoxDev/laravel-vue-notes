<template>
    <div class="desktop-header">
    <div class="card card-block topnav-left">
        <div class="card-body write-card">
            <div class="d-flex align-items-center justify-content-between">
                <div class="iq-note-callapse-menu">
                    <router-link class="iq-note-callapse-btn show-note-button"
                        :to="{name:'notes.create'}">
                        <i class="las la-pencil-alt pr-2"></i>Write Your Note
                    </router-link>
                </div>

            </div>
        </div>
    </div>

</div>
</template>

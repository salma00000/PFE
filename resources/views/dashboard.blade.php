<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_site")
        <title>Dashboard | Assistance Bot</title>
    </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                @include("Layouts.top_navbar")
            </div>
            <div class="sidebar" id="sidebar">
                @include("Layouts.left_navbar")
            </div>
            <div class="page-wrapper">
                <div class="content container-fluid mt-3">
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Dashboard</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/dashboard')}}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            @include("Layouts.footer")
        </div>
        @include("Layouts.script_site")
    </body>
</html>
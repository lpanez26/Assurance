@extends("admin.layout")
@section("content")
    <section class="content">
        <h2 class="text-center" style="font-weight: bold;padding-top: 40px;font-size: 50px;text-decoration: underline;">Bootstrap classes</h2>
        <table class="table">
            <thead>
            <tr>
                <th width="250">Class</th>
                <th>Effect</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>container</td>
                    <td><strong>Container with dynamic width for different resolutions, with padding 15px left and right. Maximum width for desktop devices is 1200px, for tables 992px and for mobile devices 768px.</strong></td>
                </tr>
                <tr>
                    <td>container-fluid</td>
                    <td><strong>Full width container which is the same width as it parents width (100%) width padding left and right 15px.</strong></td>
                </tr>
                <tr>
                    <td>row</td>
                    <td><strong>Container that includes columns col-(xs|sm|md|lg)-(1-12). Has margin: auto -15px.</strong></td>
                </tr>
                <tr>
                    <td>col-(xs|sm|md|lg)-(1-12)</td>
                    <td>
                        <strong>Number of columns on which depends the element width.</strong><br>
                        <b>xs</b> - mobile (<768px)<br><b>sm</b> - tablets (>768px и <992px)<br><b>md</b> - big tables/small desktops (>992px и <1200px)<br><b>lg</b> - big desktops (>1200px)<br>
                        <strong>Example:</strong> element with class col-sm-8 will have 8 / 12 (12 is the 100% width) for tables resolution and above. If you want different width for larger screens you set col-md-6 which will add 6 / 12 width % for big tables/small desktops and above.
                    </td>
                </tr>
                <tr>
                    <td>col-(xs|sm|md|lg)-offset-(1-12)</td>
                    <td>
                        <strong>Number of columns on which depends the element LEFT offset for every resolution.</strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2 class="text-center" style="font-weight: bold;padding-top: 40px;font-size: 50px;text-decoration: underline;">Additional classes</h2>
        <table class="table">
            <thead>
            <tr>
                <th width="250">Class</th>
                <th>Effect</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>padding-top-50</td>
                    <td>Adding inner spacing in a container. Example: padding-top-50 adding 50px top spacing, padding-top-200 adding 200px top spacing. Minumum padding-top-5, maximum padding-top-200.</td>
                </tr>
                <tr>
                    <td>padding-bottom-50</td>
                    <td>Adding inner spacing in a container. Example: padding-bottom-50 adding 50px bottom spacing, padding-bottom-200 adding 200px bottom spacing. Minumum padding-bottom-5, maximum padding-bottom-200.</td>
                </tr>
                <tr>
                    <td>padding-left-50</td>
                    <td>Adding inner spacing in a container. Example: padding-left-50 adding 50px left spacing, padding-left-200 adding 200px left spacing. Minumum padding-left-5, maximum padding-left-200.</td>
                </tr>
                <tr>
                    <td>padding-right-50</td>
                    <td>Adding inner spacing in a container. Example: padding-right-50 adding 50px right spacing, padding-right-200 adding 200px right spacing. Minumum padding-right-5, maximum padding-right-200.</td>
                </tr>
                <tr>
                    <td>margin-top-50</td>
                    <td>Adding external spacing in a container. Example: margin-top-50 adding 50px top spacing, margin-top-200 adding 200px top spacing. Minumum margin-top-5, maximum margin-top-200.</td>
                </tr>
                <tr>
                    <td>margin-bottom-50</td>
                    <td>Adding external spacing in a container. Example: margin-bottom-50 adding 50px bottom spacing, margin-bottom-200 adding 200px bottom spacing. Minumum margin-bottom-5, maximum margin-bottom-200.</td>
                </tr>
                <tr>
                    <td>margin-left-50</td>
                    <td>Adding external spacing in a container. Example: margin-left-50 adding 50px left spacing, margin-left-200 adding 200px left spacing. Minumum margin-left-5, maximum margin-left-200.</td>
                </tr>
                <tr>
                    <td>margin-right-50</td>
                    <td>Adding external spacing in a container. Example: margin-right-50 adding 50px right spacing, margin-right-200 adding 200px right spacing. Minumum margin-right-5, maximum margin-right-200.</td>
                </tr>
                <tr>
                    <td>fs-20</td>
                    <td>Changing the font size of container. Example: fs-20 makes container with font-size 20px. Minumum fs-0, maximum fs-150.</td>
                </tr>
                <tr>
                    <td>line-height-30</td>
                    <td>Add line height for container. Example: line-height-30 adds line-height: 30px. Minimum line-height-1, maximum line-height-80.</td>
                </tr>
                <tr>
                    <td>text-center</td>
                    <td>Center elements content.</td>
                </tr>
                <tr>
                    <td>text-left</td>
                    <td>Left alignment for element content.</td>
                </tr>
                <tr>
                    <td>text-right</td>
                    <td>Right alignment for element content.</td>
                </tr>
                <tr>
                    <td>max-width-300</td>
                    <td>Setting maximum possible width of container. Example: max-width-300 sets max-width: 300px to a container. This is only maximum width, if container have for example 200px width the class max-width-300 won't change his width, because 300 is the maximum width container can have, but the class is not forcing the container to be width 300px. Minimum max-width-5, maximum max-width-300.</td>
                </tr>
            </tbody>
        </table>
        <h2 class="text-center" style="font-weight: bold;padding-top: 40px;font-size: 50px;text-decoration: underline;">Additional classes - only for Mobile devices</h2>
        <table class="table">
            <thead>
            <tr>
                <th width="250">Class</th>
                <th>Effect</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>padding-top-sm-50</td>
                <td>Adding inner top spacing in a container, but only for tablet devices (768px width > && < 992px width).</td>
            </tr>
            <tr>
                <td>padding-bottom-sm-50</td>
                <td>Adding inner bottom spacing in a container, but only for tablet devices (768px width > && < 992px width).</td>
            </tr>
            <tr>
                <td>padding-left-sm-50</td>
                <td>Adding inner left spacing in a container, but only for tablet devices (768px width > && < 992px width).</td>
            </tr>
            <tr>
                <td>padding-right-sm-50</td>
                <td>Adding inner right spacing in a container, but only for tablet devices (768px width > && < 992px width).</td>
            </tr>
            <tr>
                <td>padding-top-xs-50</td>
                <td>Adding inner top spacing in a container, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>padding-bottom-xs-50</td>
                <td>Adding inner bottom spacing in a container, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>padding-left-xs-50</td>
                <td>Adding inner left spacing in a container, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>padding-right-xs-50</td>
                <td>Adding inner right spacing in a container, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>fs-xs-20</td>
                <td>Changing the font size of , but only for mobile devices (< 768px width). Example: fs-20 makes container with font-size 20px. Minumum fs-0, maximum fs-150.</td>
            </tr>
            <tr>
                <td>line-height-xs-30</td>
                <td>Add line height for container, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>hide-xs</td>
                <td>Hide elements, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>text-center-xs</td>
                <td>Center elements content, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>text-left-xs</td>
                <td>Left alignment for element content, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>text-right-xs</td>
                <td>Right alignment for element content, but only for mobile devices (< 768px width).</td>
            </tr>
            <tr>
                <td>max-width-xs-300</td>
                <td>The same affect as max-width-300, but only for mobile devices (< 768px width).</td>
            </tr>
            </tbody>
        </table>{{--
        <h2 class="text-center" style="font-weight: bold;padding-top: 40px;font-size: 50px;text-decoration: underline;">Colors</h2>
        <table class="table">
            <thead>
            <tr>
                <th width="250">Class</th>
                <th>Effect</th>
            </tr>
            </thead>
                <tbody>
                <tr>
                    <td>main_color</td>
                    <td>
                        <div style="width: 200px; height: 100px;" class="main_color-bg"></div>
                    </td>
                </tr>
                <tr>
                    <td>dark_gray</td>
                    <td>
                        <div style="width: 200px; height: 100px;" class="dark_gray-bg"></div>
                    </td>
                </tr>
                <tr>
                    <td>light_blue</td>
                    <td>
                        <div style="width: 200px; height: 100px;" class="light_blue-bg"></div>
                    </td>
                </tr>
                <tr>
                    <td>dark_blue</td>
                    <td>
                        <div style="width: 200px; height: 100px;" class="dark_blue-bg"></div>
                    </td>
                </tr>
                <tr>
                    <td>light_gray</td>
                    <td>
                        <div style="width: 200px; height: 100px;" class="light_gray-bg"></div>
                    </td>
                </tr>
                <tr>
                    <td>solid_gray</td>
                    <td>
                        <div style="width: 200px; height: 100px;" class="solid_gray-bg"></div>
                    </td>
                </tr>
            </tbody>
        </table>--}}
    </section>
@endsection
@extends('common.admin_base')

@section('title','管理后台-编辑角色权限')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 编辑角色权限 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')

    <div class="row">

        <div class="col-sm-9 col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-btns">
                        <a href="" class="panel-close">×</a>
                        <a href="" class="minimize">−</a>
                    </div>
                    <h4 class="panel-title">编辑[{{$role->role_name}}]权限</h4>
                </div>

                <form action="{{route('admin.role.pormission.save')}}" method="post" id="role-pormissions-form">
                    <div class="panel-body panel-body-nopadding">
                        <input type="hidden" name="role_id" value="{{$role->id}}">
                    {{csrf_field()}}
                    @if(!empty($pormissions))
                        @foreach($pormissions as $pormission)
                            <!--一级菜单-->
                                <div class="top-pormission col-md-12">
                                    <a href="javascript:;" class="display-sub-pormission-toggle">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                    <input type="checkbox" name="pormissions[]" value="{{$pormission['id']}}"
                                           class="top-pormission-checkbox" @if(in_array($pormission['id'], $p_ids)) checked @endif/>
                                    <label><h5><span
                                                    class="fa fa-bars"></span>&nbsp;{{$pormission['name']}}</h5></label>
                                </div>
                            @if(isset($pormission['son']))
                                <!--二级菜单-->
                                    <div class="sub-pormissions col-md-11 col-md-offset-1">
                                        <div class="col-sm-12">
                                            @foreach($pormission['son'] as $sub)
                                                <label><input type="checkbox" name="pormissions[]"
                                                              value="{{$sub['id']}}"
                                                              class="sub-pormission-checkbox" @if(in_array($sub['id'], $p_ids)) checked @endif/>&nbsp;{{$sub['name']}}
                                                </label>&nbsp;&nbsp;&nbsp;

                                        @endforeach
                                        <!-- <label><input type="checkbox" name="pormissions[]"
			                                  value=""
			                                  class="sub-pormission-checkbox" />&nbsp;&nbsp;子集分类1
			                    </label> -->
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button class="btn btn-primary" >保存</button>
                            </div>
                        </div>
                    </div><!-- panel-footer -->

                </form>

            </div>

        </div><!-- col-sm-9 -->

    </div><!-- row -->


    <script>
        $(".display-sub-pormission-toggle").toggle(function () {
            $(this).children('span').removeClass('glyphicon-minus').addClass('glyphicon-plus')
                .parents('.top-pormission').next('.sub-pormissions').hide();
        }, function () {
            $(this).children('span').removeClass('glyphicon-plus').addClass('glyphicon-minus')
                .parents('.top-pormission').next('.sub-pormissions').show();
        });
        $(".top-pormission-checkbox").change(function () {
            $(this).parents('.top-pormission').next('.sub-pormissions').find('input').prop('checked', $(this).prop('checked'));
        });
        $(".sub-pormission-checkbox").change(function () {
            if ($(this).prop('checked')) {
                $(this).parents('.sub-pormissions').prev('.top-pormission').find('.top-pormission-checkbox').prop('checked', true);
            }
        });
    </script>
    <script type="text/javascript">
        $("#save-role-pormissions").click(function (e) {
            e.preventDefault();
            Rbac.ajax.request({
                href: $("#role-pormissions-form").attr('action'),
                data: $("#role-pormissions-form").serialize(),
                successTitle: '角色权限保存成功'
            });
        });
    </script>
@endsection
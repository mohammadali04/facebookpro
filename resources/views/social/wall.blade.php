<div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Wall</h3>
                        </div>
                        <div class="panel-body">
                            <form action="{{Route('add.post')}}" method="post">
                            @csrf
                                <div class="form-group">

                                    <textarea type="email" name="description" class="form-control"
                                        placeholder="What's on your mind?"></textarea>
                                </div>

                                <button type="submit" class="btn btn-default">Submit</button>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default"><i class="fa fa-pencil"
                                                aria-hidden="true"></i> Text</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-file-image-o"
                                                aria-hidden="true"></i> Image</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-file-video-o"
                                                aria-hidden="true"></i> Video</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
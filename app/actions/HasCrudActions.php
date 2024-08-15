<?php

namespace app\actions;

trait HasCrudActions
{
    use IndexAction;
    use CreateAction;
    use ViewAction;
    use UpdateAction;
    use DeleteAction;
}

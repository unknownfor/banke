<?php
namespace App\Models;
use Auth;
use Illuminate\Support\Facades\Log;
trait ActionAttributeTrait{

	protected $html_build;

	protected $certificationIconArr=Array('order','recruiteteacher','drawback');
	protected $certificateInListArr=Array('marketingambassador','commentappstore');

	/**
	 * 查看按钮
	 * @param bool $type
	 * @return $this
	 */
	public function getShowActionButton($type = true)
	{
		//开启查看按钮
		if (config('admin.global.'.$this->action.'.show')) {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.show'))) {
				if ($type) {
					$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id).'" class="btn btn-xs btn-info tooltips" data-container="body" data-original-title="' . trans('labels.view') . '"  data-placement="top"><i class="fa fa-search"></i></a>';
					return $this;
				}
				$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id).'" class="btn btn-xs btn-info tooltips" data-toggle="modal" data-target="#draggable" data-container="body" data-original-title="' . trans('labels.'.$this->action.'.show') . '"  data-placement="top"><i class="fa fa-search"></i></a>';
			}

		}
		return $this;
	}

	/**
	 * 修改按钮
	 * @return $this
	 */
	public function getEditActionButton()
	{
		if ($this->action == 'withdraw') {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.financialedit'))
				|| Auth::user()->can(config('admin.permissions.'.$this->action.'.edit'))) {
				$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/edit').'" class="btn btn-xs btn-primary tooltips" data-original-title="' . trans('crud.check') . '"  data-placement="top"><i class="fa fa-check"></i></a>';
			}
			return $this;
		}
		if (in_array($this->action,$this->certificationIconArr) || in_array($this->action,$this->certificateInListArr)) {
			return $this;
		}

		if (Auth::user()->can(config('admin.permissions.'.$this->action.'.edit'))) {
			$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/edit').'" class="btn btn-xs btn-primary tooltips" data-original-title="' . trans('crud.edit') . '"  data-placement="top"><i class="fa fa-pencil"></i></a>';
		}
		return $this;
	}

	/**
	 * 添加回收站/禁用按钮
	 * @return $this
	 */
	public function getTrashActionButton()
	{
		if (($this->status == config('admin.global.status.active')) || ($this->status == config('admin.global.status.audit')) ) {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.trash'))) {
				$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/mark/'.config('admin.global.status.trash')).'" class="btn btn-xs btn-danger tooltips" data-container="body" data-original-title="' . trans('crud.trash') . '"  data-placement="top"><i class="fa fa-pause"></i></a>';
			}
		}
		return $this;
	}

	/**
	 * 从回收站恢复到待审核状态
	 * @return $this
	 */
	public function getUndoActionButton()
	{
		if (($this->status == config('admin.global.status.destroy')) || ($this->status == config('admin.global.status.trash'))) {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.undo'))) {
				$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/mark/'.config('admin.global.status.audit')).'" class="btn btn-xs btn-danger tooltips" data-container="body" data-original-title="' . trans('crud.undo') . '"  data-placement="top"><i class="fa fa-reply"></i></a>';
			}
		}
		return $this;
	}

	/**
	 * 通过审核按钮
	 * @return $this
	 */
	public function getAuditActionButton()
	{
		if (($this->status == config('admin.global.status.audit'))) {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.audit'))) {
				$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/mark/'.config('admin.global.status.active')).'" class="btn btn-xs btn-primary tooltips" data-container="body" data-original-title="' . trans('crud.audit') . '"  data-placement="top"><i class="fa fa-check"></i></a>';
			}
		}
		return $this;
	}

	/**
	 * 软删除按钮
	 * @return $this
	 */
	public function getDestroyActionButton()
	{
		if (($this->status != config('admin.global.status.active'))) {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.destroy'))) {
				$this->html_build .= '<a href="javascript:;" onclick="return false" class="btn btn-xs btn-danger tooltips" data-container="body" data-original-title="' . trans('crud.destory') . '"  data-placement="top" id="destory"><i class="fa fa-trash"></i><form action="'.url('admin/'.$this->action.'/'.$this->id).'" method="POST" name="delete_item" style="display:none"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
			}
		}
		return $this;
	}



	/**
	 * 修改用户密码
	 * @return $this
	 */
	public function getResetActionButton()
	{
		if (Auth::user()->can(config('admin.permissions.'.$this->action.'.reset'))) {
			$this->html_build .= '<a href="'.url('admin/user/'.$this->id.'/reset').'" class="btn btn-xs btn-danger tooltips" data-container="body" data-original-title="' . trans('crud.reset') . '"  data-placement="top"><i class="fa fa-lock"></i></a>';
		}
		return $this;
	}

	/**
	 * 用户实名认证按钮
	 * @return $this
	 */
	public function getCertificateActionButton()
	{
		if($this->action=='app_user') {
			if ((!empty($this->certification_status) && $this->certification_status != config('admin.global.certification_status.audit'))) {
				if (Auth::user()->can(config('admin.permissions.' . $this->action . '.certificate'))) {
					$this->html_build .= '<a href="' . url('admin/' . $this->action . '/' . $this->uid . '/certificate/' . config('admin.global.certification_status.audit')) . '" class="btn btn-xs btn-primary tooltips" data-container="body" data-original-title="' . trans('crud.audit') . '"  data-placement="top"><i class="fa fa-check"></i></a>';
				}
			}
		}
		return $this;
	}

	/**
	 * 拒绝用户实名认证按钮
	 * @return $this
	 */
	public function getRefuseCertificateActionButton()
	{
		if($this->action=='app_user') {
			if ((!empty($this->certification_status) && $this->certification_status != config('admin.global.certification_status.audit'))) {
				if (Auth::user()->can(config('admin.permissions.' . $this->action . '.certificate'))) {
					$this->html_build .= '<a href="' . url('admin/' . $this->action . '/' . $this->uid . '/certificate/' . config('admin.global.certification_status.trash')) . '" class="btn btn-xs btn-primary tooltips" data-container="body" data-original-title="' . trans('crud.refuse') . '"  data-placement="top"><i class="fa fa-pause"></i></a>';
				}
			}
		}
		return $this;
	}

	/**
	 * 认证按钮
	 * @return $this
	 */
	public function getCheckActionButton()
	{
		if(in_array($this->action,$this->certificationIconArr)){
			if (($this->status == config('admin.global.'.$this->action.'.audit'))) {
				if (Auth::user()->can(config('admin.permissions.' . $this->action . '.edit'))) {
					$this->html_build .= '<a href="' . url('admin/' . $this->action . '/' . $this->id . '/edit') . '" class="btn btn-xs btn-primary tooltips" data-original-title="' . trans('crud.check') . '"  data-placement="top"><i class="fa fa-check"></i></a>';
				}
			}
		}
		return $this;
	}

	/**
	 * 拒绝用户报名认证按钮
	 * @return $this
	 */
	public function getOrderRefuseActionButton()
	{
//		if (($this->action == 'order') || ($this->action == 'drawback')) {
		if (($this->action == 'order')) {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.certificate'))) {
				$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->uid.'/certificate/'.config('admin.global.certification_status.trash')).'" class="btn btn-xs btn-primary tooltips" data-container="body" data-original-title="' . trans('crud.refuse') . '"  data-placement="top"><i class="fa fa-pause"></i></a>';
			}
		}
		return $this;
	}

	/**
	 * 提现认证按钮
	 * @return $this
	 */
//	public function getWithdrawActionButton()
//	{
//		if (($this->status == config('admin.global.withdraw_status.audit'))) {
//			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.editWithdraw'))) {
//				$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/edit').'" class="btn btn-xs btn-primary tooltips" data-original-title="' . trans('crud.edit') . '"  data-placement="top"><i class="fa fa-pencil"></i></a>';
//			}
//		}else{
//			$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id).'" class="btn btn-xs btn-info tooltips" data-container="body" data-original-title="' . trans('labels.view') . '"  data-placement="top"><i class="fa fa-search"></i></a>';
//		}
//		return $this;
//	}

	/**
	 * 退款认证按钮
	 * @return $this
	 */
	public function getDrawbackActionButton()
	{
		if (($this->action == 'drawback')) {
			if ($this->status == config('admin.global.drawback.audit')) {
				if (Auth::user()->can(config('admin.permissions.' . $this->action . '.edit'))) {
					$this->html_build .= '<a href="' . url('admin/' . $this->action . '/' . $this->id . '/edit') . '" class="btn btn-xs btn-primary tooltips" data-original-title="' . trans('crud.check') . '"  data-placement="top"><i class="fa fa-check"></i></a>';
				}
			}
		}
		return $this;
	}


	/**
	 * 通过认证按钮 直接在列表认证
	 * @return $this
	 */
	public function getCertificateInListButton()
	{
		if(in_array($this->action,$this->certificateInListArr)){
			if ($this->certification_status == config('admin.global.status.audit')) {
				if (Auth::user()->can(config('admin.permissions.' . $this->action . '.certificate'))) {
					$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/certificate/'.config('admin.global.status.active')).'" class="btn btn-xs btn-primary tooltips" data-container="body" data-original-title="' . trans('crud.audit') . '"  data-placement="top"><i class="fa fa-check"></i></a>';
				}
			}
		}
		return $this;
	}

	/**
	 * 拒绝认证按钮 直接在列表认证
	 * @return $this
	 */
	public function getRefuseCertificateInListButton()
	{
		if(in_array($this->action,$this->certificateInListArr)){
			if ($this->certification_status == config('admin.global.status.audit')) {
				if (Auth::user()->can(config('admin.permissions.' . $this->action . '.certificate'))) {
					$this->html_build .= '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/certificate/'.config('admin.global.status.ban')).'" class="btn btn-xs btn-primary tooltips" data-container="body" data-original-title="' . trans('crud.refuse') . '"  data-placement="top"><i class="fa fa-pause"></i></a>';
				}
			}
		}
		return $this;
	}


	/**
	 * 组合按钮
	 * @param bool $showType
	 * @return $this
	 */

	public function getActionButtonAttribute($showType = true)
	{
		
		$this->getShowActionButton($showType)
					->getCheckActionButton()
					->getOrderRefuseActionButton()
					->getResetActionButton()
					->getEditActionButton()
					->getUndoActionButton()
					->getAuditActionButton()
					->getTrashActionButton()
					->getDestroyActionButton()
					->getCertificateActionButton()
					->getRefuseCertificateActionButton()
					->getCertificateInListButton()
					->getRefuseCertificateInListButton()
					->getDrawbackActionButton();

		return $this->html_build;
	}
}
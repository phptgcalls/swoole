<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true join true leave true invite true ban true unban true kick true unkick true promote true demote true info true settings true pinned true edit true delete true group_call true invites true send true forums true sub_extend
 * @return ChannelAdminLogEventsFilter
 */

final class ChannelAdminLogEventsFilter extends Instance {
	public function request(? true $join = null,? true $leave = null,? true $invite = null,? true $ban = null,? true $unban = null,? true $kick = null,? true $unkick = null,? true $promote = null,? true $demote = null,? true $info = null,? true $settings = null,? true $pinned = null,? true $edit = null,? true $delete = null,? true $group_call = null,? true $invites = null,? true $send = null,? true $forums = null,? true $sub_extend = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xea107ae4);
		$flags = 0;
		$flags |= is_null($join) ? 0 : (1 << 0);
		$flags |= is_null($leave) ? 0 : (1 << 1);
		$flags |= is_null($invite) ? 0 : (1 << 2);
		$flags |= is_null($ban) ? 0 : (1 << 3);
		$flags |= is_null($unban) ? 0 : (1 << 4);
		$flags |= is_null($kick) ? 0 : (1 << 5);
		$flags |= is_null($unkick) ? 0 : (1 << 6);
		$flags |= is_null($promote) ? 0 : (1 << 7);
		$flags |= is_null($demote) ? 0 : (1 << 8);
		$flags |= is_null($info) ? 0 : (1 << 9);
		$flags |= is_null($settings) ? 0 : (1 << 10);
		$flags |= is_null($pinned) ? 0 : (1 << 11);
		$flags |= is_null($edit) ? 0 : (1 << 12);
		$flags |= is_null($delete) ? 0 : (1 << 13);
		$flags |= is_null($group_call) ? 0 : (1 << 14);
		$flags |= is_null($invites) ? 0 : (1 << 15);
		$flags |= is_null($send) ? 0 : (1 << 16);
		$flags |= is_null($forums) ? 0 : (1 << 17);
		$flags |= is_null($sub_extend) ? 0 : (1 << 18);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['join'] = true;
		else:
			$result['join'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['leave'] = true;
		else:
			$result['leave'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['invite'] = true;
		else:
			$result['invite'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['ban'] = true;
		else:
			$result['ban'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['unban'] = true;
		else:
			$result['unban'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['kick'] = true;
		else:
			$result['kick'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['unkick'] = true;
		else:
			$result['unkick'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['promote'] = true;
		else:
			$result['promote'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['demote'] = true;
		else:
			$result['demote'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['info'] = true;
		else:
			$result['info'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['settings'] = true;
		else:
			$result['settings'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['edit'] = true;
		else:
			$result['edit'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['delete'] = true;
		else:
			$result['delete'] = false;
		endif;
		if($flags & (1 << 14)):
			$result['group_call'] = true;
		else:
			$result['group_call'] = false;
		endif;
		if($flags & (1 << 15)):
			$result['invites'] = true;
		else:
			$result['invites'] = false;
		endif;
		if($flags & (1 << 16)):
			$result['send'] = true;
		else:
			$result['send'] = false;
		endif;
		if($flags & (1 << 17)):
			$result['forums'] = true;
		else:
			$result['forums'] = false;
		endif;
		if($flags & (1 << 18)):
			$result['sub_extend'] = true;
		else:
			$result['sub_extend'] = false;
		endif;
		return new self($result);
	}
}

?>
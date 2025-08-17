<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int start_date true participating true preparing_results int joined_too_early_date long admin_disallowed_chat_id string disallowed_country
 * @return payments.GiveawayInfo
 */

final class GiveawayInfo extends Instance {
	public function request(int $start_date,? true $participating = null,? true $preparing_results = null,? int $joined_too_early_date = null,? int $admin_disallowed_chat_id = null,? string $disallowed_country = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4367daa0);
		$flags = 0;
		$flags |= is_null($participating) ? 0 : (1 << 0);
		$flags |= is_null($preparing_results) ? 0 : (1 << 3);
		$flags |= is_null($joined_too_early_date) ? 0 : (1 << 1);
		$flags |= is_null($admin_disallowed_chat_id) ? 0 : (1 << 2);
		$flags |= is_null($disallowed_country) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->writeInt($start_date);
		if(is_null($joined_too_early_date) === false):
			$writer->writeInt($joined_too_early_date);
		endif;
		if(is_null($admin_disallowed_chat_id) === false):
			$writer->writeLong($admin_disallowed_chat_id);
		endif;
		if(is_null($disallowed_country) === false):
			$writer->tgwriteBytes($disallowed_country);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['participating'] = true;
		else:
			$result['participating'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['preparing_results'] = true;
		else:
			$result['preparing_results'] = false;
		endif;
		$result['start_date'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['joined_too_early_date'] = $reader->readInt();
		else:
			$result['joined_too_early_date'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['admin_disallowed_chat_id'] = $reader->readLong();
		else:
			$result['admin_disallowed_chat_id'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['disallowed_country'] = $reader->tgreadBytes();
		else:
			$result['disallowed_country'] = null;
		endif;
		return new self($result);
	}
}

?>
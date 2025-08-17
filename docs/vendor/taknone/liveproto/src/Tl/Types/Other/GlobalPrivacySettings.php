<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true archive_and_mute_new_noncontact_peers true keep_archived_unmuted true keep_archived_folders true hide_read_marks true new_noncontact_peers_require_premium true display_gifts_button long noncontact_peers_paid_stars disallowedgiftssettings disallowed_gifts
 * @return GlobalPrivacySettings
 */

final class GlobalPrivacySettings extends Instance {
	public function request(? true $archive_and_mute_new_noncontact_peers = null,? true $keep_archived_unmuted = null,? true $keep_archived_folders = null,? true $hide_read_marks = null,? true $new_noncontact_peers_require_premium = null,? true $display_gifts_button = null,? int $noncontact_peers_paid_stars = null,? object $disallowed_gifts = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfe41b34f);
		$flags = 0;
		$flags |= is_null($archive_and_mute_new_noncontact_peers) ? 0 : (1 << 0);
		$flags |= is_null($keep_archived_unmuted) ? 0 : (1 << 1);
		$flags |= is_null($keep_archived_folders) ? 0 : (1 << 2);
		$flags |= is_null($hide_read_marks) ? 0 : (1 << 3);
		$flags |= is_null($new_noncontact_peers_require_premium) ? 0 : (1 << 4);
		$flags |= is_null($display_gifts_button) ? 0 : (1 << 7);
		$flags |= is_null($noncontact_peers_paid_stars) ? 0 : (1 << 5);
		$flags |= is_null($disallowed_gifts) ? 0 : (1 << 6);
		$writer->writeInt($flags);
		if(is_null($noncontact_peers_paid_stars) === false):
			$writer->writeLong($noncontact_peers_paid_stars);
		endif;
		if(is_null($disallowed_gifts) === false):
			$writer->write($disallowed_gifts->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['archive_and_mute_new_noncontact_peers'] = true;
		else:
			$result['archive_and_mute_new_noncontact_peers'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['keep_archived_unmuted'] = true;
		else:
			$result['keep_archived_unmuted'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['keep_archived_folders'] = true;
		else:
			$result['keep_archived_folders'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['hide_read_marks'] = true;
		else:
			$result['hide_read_marks'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['new_noncontact_peers_require_premium'] = true;
		else:
			$result['new_noncontact_peers_require_premium'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['display_gifts_button'] = true;
		else:
			$result['display_gifts_button'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['noncontact_peers_paid_stars'] = $reader->readLong();
		else:
			$result['noncontact_peers_paid_stars'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['disallowed_gifts'] = $reader->tgreadObject();
		else:
			$result['disallowed_gifts'] = null;
		endif;
		return new self($result);
	}
}

?>
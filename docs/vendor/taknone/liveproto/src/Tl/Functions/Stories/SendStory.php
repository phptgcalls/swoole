<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputmedia media Vector<InputPrivacyRule> privacy_rules long random_id true pinned true noforwards true fwd_modified Vector<MediaArea> media_areas string caption Vector<MessageEntity> entities int period inputpeer fwd_from_id int fwd_from_story Vector<int> albums
 * @return Updates
 */

final class SendStory extends Instance {
	public function request(object $peer,object $media,array $privacy_rules,int $random_id,? true $pinned = null,? true $noforwards = null,? true $fwd_modified = null,? array $media_areas = null,? string $caption = null,? array $entities = null,? int $period = null,? object $fwd_from_id = null,? int $fwd_from_story = null,? array $albums = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x737fc2ec);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 2);
		$flags |= is_null($noforwards) ? 0 : (1 << 4);
		$flags |= is_null($fwd_modified) ? 0 : (1 << 7);
		$flags |= is_null($media_areas) ? 0 : (1 << 5);
		$flags |= is_null($caption) ? 0 : (1 << 0);
		$flags |= is_null($entities) ? 0 : (1 << 1);
		$flags |= is_null($period) ? 0 : (1 << 3);
		$flags |= is_null($fwd_from_id) ? 0 : (1 << 6);
		$flags |= is_null($fwd_from_story) ? 0 : (1 << 6);
		$flags |= is_null($albums) ? 0 : (1 << 8);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->write($media->read());
		if(is_null($media_areas) === false):
			$writer->tgwriteVector($media_areas,'MediaArea');
		endif;
		if(is_null($caption) === false):
			$writer->tgwriteBytes($caption);
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		$writer->tgwriteVector($privacy_rules,'InputPrivacyRule');
		$writer->writeLong($random_id);
		if(is_null($period) === false):
			$writer->writeInt($period);
		endif;
		if(is_null($fwd_from_id) === false):
			$writer->write($fwd_from_id->read());
		endif;
		if(is_null($fwd_from_story) === false):
			$writer->writeInt($fwd_from_story);
		endif;
		if(is_null($albums) === false):
			$writer->tgwriteVector($albums,'int');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>
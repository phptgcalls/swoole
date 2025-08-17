<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id int date int expire_date messagemedia media true pinned true public true close_friends true min true noforwards true edited true contacts true selected_contacts true out peer from_id storyfwdheader fwd_from string caption Vector<MessageEntity> entities Vector<MediaArea> media_areas Vector<PrivacyRule> privacy storyviews views reaction sent_reaction Vector<int> albums
 * @return StoryItem
 */

final class StoryItem extends Instance {
	public function request(int $id,int $date,int $expire_date,object $media,? true $pinned = null,? true $public = null,? true $close_friends = null,? true $min = null,? true $noforwards = null,? true $edited = null,? true $contacts = null,? true $selected_contacts = null,? true $out = null,? object $from_id = null,? object $fwd_from = null,? string $caption = null,? array $entities = null,? array $media_areas = null,? array $privacy = null,? object $views = null,? object $sent_reaction = null,? array $albums = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xedf164f1);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 5);
		$flags |= is_null($public) ? 0 : (1 << 7);
		$flags |= is_null($close_friends) ? 0 : (1 << 8);
		$flags |= is_null($min) ? 0 : (1 << 9);
		$flags |= is_null($noforwards) ? 0 : (1 << 10);
		$flags |= is_null($edited) ? 0 : (1 << 11);
		$flags |= is_null($contacts) ? 0 : (1 << 12);
		$flags |= is_null($selected_contacts) ? 0 : (1 << 13);
		$flags |= is_null($out) ? 0 : (1 << 16);
		$flags |= is_null($from_id) ? 0 : (1 << 18);
		$flags |= is_null($fwd_from) ? 0 : (1 << 17);
		$flags |= is_null($caption) ? 0 : (1 << 0);
		$flags |= is_null($entities) ? 0 : (1 << 1);
		$flags |= is_null($media_areas) ? 0 : (1 << 14);
		$flags |= is_null($privacy) ? 0 : (1 << 2);
		$flags |= is_null($views) ? 0 : (1 << 3);
		$flags |= is_null($sent_reaction) ? 0 : (1 << 15);
		$flags |= is_null($albums) ? 0 : (1 << 19);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->writeInt($date);
		if(is_null($from_id) === false):
			$writer->write($from_id->read());
		endif;
		if(is_null($fwd_from) === false):
			$writer->write($fwd_from->read());
		endif;
		$writer->writeInt($expire_date);
		if(is_null($caption) === false):
			$writer->tgwriteBytes($caption);
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		$writer->write($media->read());
		if(is_null($media_areas) === false):
			$writer->tgwriteVector($media_areas,'MediaArea');
		endif;
		if(is_null($privacy) === false):
			$writer->tgwriteVector($privacy,'PrivacyRule');
		endif;
		if(is_null($views) === false):
			$writer->write($views->read());
		endif;
		if(is_null($sent_reaction) === false):
			$writer->write($sent_reaction->read());
		endif;
		if(is_null($albums) === false):
			$writer->tgwriteVector($albums,'int');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 5)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['public'] = true;
		else:
			$result['public'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['close_friends'] = true;
		else:
			$result['close_friends'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['min'] = true;
		else:
			$result['min'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['noforwards'] = true;
		else:
			$result['noforwards'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['edited'] = true;
		else:
			$result['edited'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['contacts'] = true;
		else:
			$result['contacts'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['selected_contacts'] = true;
		else:
			$result['selected_contacts'] = false;
		endif;
		if($flags & (1 << 16)):
			$result['out'] = true;
		else:
			$result['out'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 18)):
			$result['from_id'] = $reader->tgreadObject();
		else:
			$result['from_id'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['fwd_from'] = $reader->tgreadObject();
		else:
			$result['fwd_from'] = null;
		endif;
		$result['expire_date'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['caption'] = $reader->tgreadBytes();
		else:
			$result['caption'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		$result['media'] = $reader->tgreadObject();
		if($flags & (1 << 14)):
			$result['media_areas'] = $reader->tgreadVector('MediaArea');
		else:
			$result['media_areas'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['privacy'] = $reader->tgreadVector('PrivacyRule');
		else:
			$result['privacy'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['views'] = $reader->tgreadObject();
		else:
			$result['views'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['sent_reaction'] = $reader->tgreadObject();
		else:
			$result['sent_reaction'] = null;
		endif;
		if($flags & (1 << 19)):
			$result['albums'] = $reader->tgreadVector('int');
		else:
			$result['albums'] = null;
		endif;
		return new self($result);
	}
}

?>